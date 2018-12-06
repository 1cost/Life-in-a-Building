#!/usr/bin/python

import os
import sys
import signal
import argparse
import time
import urllib
import numpy as np
import cv2
from multiprocessing import Process, Queue

from ips import *

loop = True
def signalHandler(signal,frame):
  global loop
  print "Exiting Loop"
  loop = False

def getCurTime():
  t = time.localtime()
  h = str(t.tm_hour)
  h = h.rjust(2,"0")
  m = str(t.tm_min)
  m = m.rjust(2,"0")
  s = str(t.tm_sec)
  s = s.rjust(2,"0")
  return str(h+"_"+m+"_"+s)

def getImg(ip):
  # Access the image and convert bytes to numpy array
  req = urllib.urlopen("http://"+ip+"/axis-cgi/jpg/image.cgi")
  arr = np.asarray(bytearray(req.read()), dtype=np.uint8)
  img = cv2.imdecode(arr, -1)
  return img

# Collect and store a frame about every second
# Access the image at the ip address given 
# Write metadata about the collection to meta.txt
def collectData(loc, ip):
  directory = getCurTime()                
  os.mkdir(directory)                           # Make directory named the current time
  print "Data stored in directory:", directory

  count = 0
  metafile = open(str(directory+"/meta.txt"),"w")   # Open file and write metadata
  metafile.write("Metadata for frame collection\n")
  metafile.write("Location: "+str(loc)+"\n")
  metafile.write("Start Time: "+str(directory)+"\n")

  # Run until ctrl-c (SIGINT)
  while loop:
    try:
      img = getImg(ip)
      t = getCurTime()+".jpg"
      print t

      # Store the image in hour_min_sec.jpg format
      cv2.imwrite(str(directory+"/"+t),img)
      count+=1
    except:
      print "Error: Could not read in data. Attempting to reconnect."
      exit(1)

    time.sleep(0.8) # Sleep for almost a second until next frame

  # Write the number of images to meta.txt and close the file
  metafile.write("Total Frames: "+str(count))
  metafile.close()

def writer(queue):
  while loop:
    img = getImg(ips[index][1])
    queue.put(img)
    time.sleep(0.8)

def reader(queue):
  i = 1
  while loop:
    img = queue.get()
    cv2.imwrite("pic"+str(i)+".jpg",img)
    i+=1
    time.sleep(0.8)

##### Main #####
feed = ""
parser = argparse.ArgumentParser(description="Choose the operations to perform.")
parser.add_argument("password", help="Insert database password")
parser.add_argument("-c","--collect", nargs=1, dest="cname", help="Collect frames")
parser.add_argument("-s","--system", nargs=1, dest="sname", help="Funnel to the system")

args = parser.parse_args()

ips = storeIPs(args.password)

if args.cname:
  index = ipSwitch(args.cname[0])
  signal.signal(signal.SIGINT, signalHandler)   # Edit ctrl-c to end the loop
  collectData(args.cname[0], ips[index][1])

elif args.sname:
  index = ipSwitch(args.sname[0])
  q = Queue()

  p = Process(target=reader, args=(q,))
  signal.signal(signal.SIGINT, signalHandler)   # Edit ctrl-c to end the loop
  p.start()

  writer(q)
  p.join()

else:
  print "Requires options"
