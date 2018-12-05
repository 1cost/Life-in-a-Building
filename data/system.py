#!/usr/bin/python

import os
import sys
import signal
import argparse
import time
import urllib
import numpy as np
import cv2

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

# Collect and store a frame about every second
# Access the image at the ip address given 
# Write metadata about the collection to meta.txt
def collectData(loc, ip):
  signal.signal(signal.SIGINT, signalHandler)   # Edit ctrl-c to end the loop
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
      # Access the image and convert bytes to numpy array
      req = urllib.urlopen("http://"+ip+"/axis-cgi/jpg/image.cgi")
      arr = np.asarray(bytearray(req.read()), dtype=np.uint8)
      img = cv2.imdecode(arr, -1)

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

def funnelData(queue):
  print "queue"


##### Main #####
feed = ""
parser = argparse.ArgumentParser(description="Choose the operations to perform.")
parser.add_argument("password", help="Insert database password")
parser.add_argument("-c","--collect", nargs=1, dest="cname", help="Collect frames")
parser.add_argument("-s","--system", nargs=1, dest="sname", help="Funnel to the system")

args = parser.parse_args()

ips = storeIPs(args.password)

if args.cname:
  x = ipSwitch(args.cname[0])
  collectData(args.cname[0], ips[x][1])
elif args.sname:
  print args.sname[0]
  for x in ips:
    print x
else:
  print "Requires options"
