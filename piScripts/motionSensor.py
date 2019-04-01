from gpiozero import MotionSensor
import time
import datetime

pir = MotionSensor(4)

def sendData(pir):
    pir.wait_for_motion()
    time = str(datetime.datetime.now())[:19]
    data = time[0:4] + time[5:7] + time[8:10] + time[11:13] + time[14:16] + time[17:19]
    return data
