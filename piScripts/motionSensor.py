from gpiozero import MotionSensor
import time
import datetime

pir = MotionSensor(4)

def sendData(pir):
    pir.wait_for_motion()
    time = str(datetime.datetime.now())[:19]
    data = time[0:3] + time[5:6] + time[8:9] + time[11:12] + time[14:15] + time[17:18]
    return data
