# MAKE SURE THE PI FILE RETURNS A STRING WHEN A MOTION IS DETECTED

import motionSensor

prevMotion = "";
f = open("motion.txt", "a")
while(True):
    while(True):

        # Assumed getMotion will properly wait until input is received so no waiting required in this script
        motion = motionSensor.sendData(motionSensor.pir)
        if(motion != prevMotion):
            prevMotion = motion
            break;
    motion = motion + '\n'
    f.write(motion)
