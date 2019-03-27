#!/usr/bin/python

# Import outside libraries for the system to run
import time
import urllib
import numpy as np
import cv2

# Import functions
from ips import *

# Return the current time
def getCurTime():
  t = time.localtime()
  s = time.strftime("%d_%b_%y_%H_%M_%S", t)
  return s

# Return an image from a given ip address
def getImg(ip):
  # Access the image and convert bytes to numpy array
  req = urllib.urlopen("http://"+ip+"/axis-cgi/jpg/image.cgi")
  arr = np.asarray(bytearray(req.read()), dtype=np.uint8)
  img = cv2.imdecode(arr, -1)
  return img

# Draw bounding box based on object detection
def draw_bounding_box(img, class_id, confidence, x, y, x_plus_w, y_plus_h):
  label = str(class_id)
  color = [0,255,0]
  cv2.rectangle(img, (x,y), (x_plus_w,y_plus_h), color, 2)
  cv2.putText(img, label, (x-10,y-10), cv2.FONT_HERSHEY_SIMPLEX, 0.5, color, 2)
