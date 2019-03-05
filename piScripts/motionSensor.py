from gpiozero import MotionSensor
import time
import datetime

pir = MotionSensor(4)

def sendData(pir):
    pir.wait_for_motion()
    data = str(datetime.datetime.now())[:19]
    return data
