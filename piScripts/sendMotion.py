# MAKE SURE THE PI FILE RETURNS A STRING WHEN A MOTION IS DETECTED

import motionSensor
import requests

prevMotion = "";
while(True):
    while(True):

        # Assumed getMotion will properly wait until input is received so no waiting required in this script
        motion = motionSensor.sendData(motionSensor.pir)
        if(motion != prevMotion):
            prevMotion = motion
            break;
    result = requests.get("http://www.thistle-tech.com/piput.pl?val=" + motion)    
