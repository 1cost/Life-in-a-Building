#!/usr/bin/python

# Import outside libraries for the system to run
import os
import sys
import signal
import argparse
import time
import urllib
import numpy as np
import cv2
import random
from multiprocessing import Process, Queue

# Import functions
from ips import *

loop = True
def signalHandler(signal,frame):
  global loop
  print "Exiting Loop"
  loop = False

# Return the current time
def getCurTime():
  t = time.localtime()
  s = time.strftime("%d %b %y %H:%M:%S", t)
  return s

# Return an image from a given ip address
def getImg(ip):
  # Access the image and convert bytes to numpy array
  req = urllib.urlopen("http://"+ip+"/axis-cgi/jpg/image.cgi")
  arr = np.asarray(bytearray(req.read()), dtype=np.uint8)
  img = cv2.imdecode(arr, -1)
  return img

def writer(queue, ip):
  img = getImg(ip)
  while loop:
    try:  
      queue.put(img)
    except queue.Full:
      print "Queue is full! Dumping old data."
      for _ in range(10):
        queue.get()
      queue.put(img)

    prev_img = img
    while True:
      img = getImg(ip)
      if (img == prev_img).all():
        continue
      else:
        break

def reader(queue):
  i = 0
  while loop:
    img = queue.get()
    cv2.imwrite("pic"+str(i)+".jpg",img)
    print "pic"+str(i)+".jpg"
    i+=1
    time.sleep(0.8)

# Collect and store a frame about every second
# Access the image at the ip address given 
# Write metadata about the collection to meta.txt
def collectData(loc, ip, directory):
  os.mkdir(directory)                           # Make directory named the current time
  print "Data stored in directory:", directory

  count = 0
  metafile = open(str(directory+"/meta.txt"),"w")   # Open file and write metadata
  metafile.write("Metadata for frame collection\n")
  metafile.write("Location: "+str(loc)+"\n")
  metafile.write("Start Time: "+str(getCurTime())+"\n")

  # Run until ctrl-c (SIGINT)
  img = getImg(ip)
  while loop:
    try:
      t = "pic"+str(count)+".jpg"
      print t

      # Store the image in pic#.jpg format
      cv2.imwrite(str(directory+"/"+t),img)
      count+=1
    except:
      print "Error: Could not read in data. Attempting to reconnect."
      exit(1)

    prev_img = img
    while True:
      img = getImg(ip)
      if (img == prev_img).all():
        continue
      else:
        break

  # Write the number of images to meta.txt and close the file
  metafile.write("Total Frames: "+str(count)+"\n")
  metafile.write("End Time: "+str(getCurTime())+"\n")
  metafile.close()

##### Main #####
parser = argparse.ArgumentParser(description="Choose the operations to perform.")
parser.add_argument("password", help="Insert database password")
parser.add_argument("-c","--collect", nargs=1, dest="cname", help="Collect frames")
parser.add_argument("-s","--system", nargs=1, dest="sname", help="Funnel to the system")
parser.add_argument("-d","--directory", nargs=1, dest="dir", help="Name of directory")

args = parser.parse_args()

ips = storeIPs(args.password)

# Run the data collection if -c or --collect is provided
if args.cname:
  index = ipSwitch(args.cname[0])
  signal.signal(signal.SIGINT, signalHandler)   # Edit ctrl-c to end the loop
  if args.dir:
    collectData(args.cname[0], ips[index][1], args.dir[0])
  else:
    collectData(args.cname[0], ips[index][1], "c"+str(random.randint(100,1000)))

elif args.sname:
  index = ipSwitch(args.sname[0])
  signal.signal(signal.SIGINT, signalHandler)   # Edit ctrl-c to end the loop
  q = Queue(10)
  p = Process(target=reader, args=(q,))
  p.start()
  writer(q, ips[index][1])
  p.join()

else:
  print "Requires options"
