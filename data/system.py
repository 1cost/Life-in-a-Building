#!/usrbin/python

import sys
import argparse
import time
import urllib
import numpy as np
import cv2

def getCurTime():
  t = time.localtime()
  h = str(t.tm_hour)
  m = str(t.tm_min)
  s = str(t.tm_sec)
  return str(h+":"+m+":"+s)

def collectData():
  while True:
    try:
      req = urllib.urlopen("http://10.17.166.21/axis-cgi/jpg/image.cgi")
      arr = np.asarray(bytearray(req.read()), dtype=np.uint8)
      img = cv2.imdecode(arr, -1)

      t = getCurTime()+".jpg"
      print t
      cv2.imwrite(str(t),img)
    except:
      print "Error: Could not read in data. Attempting to reconnect."
      #exit(1)

    time.sleep(0.8)

# Main
feed = ""
parser = argparse.ArgumentParser(description="Choose the operations to perform.")
parser.add_argument("-c","--collect", nargs=1, dest="cname", help="Collect frames")
parser.add_argument("-s","--system", nargs=1, dest="sname", help="Funnel to the system")

args = parser.parse_args()

if args.cname:
  print args.cname[0]
elif args.sname:
  print args.sname[0]
