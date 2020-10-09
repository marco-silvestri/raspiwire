from gpiozero import OutputDevice
from time import sleep
from sys import exit
import subprocess

relay = OutputDevice(18, active_high=False, initial_value=False)
state = 0

if state == 0:
    relay.on()
    state = 1
    #sleep(10)
    #nasMount = subprocess.Popen(['mount /dev/sda2 /server_mount/nas', 'More output'],
                    #stdout=subprocess.PIPE, 
                    #stderr=subprocess.PIPE)
    #stdout, stderr = process.communicate()
    #stdout, stderr
    sys.exit(1)
elif state == 1:
    #sleep(10)
    #nasMount = subprocess.Popen(['umount /dev/sda2 /server_mount/nas', 'More output'],
    #                stdout=subprocess.PIPE, 
    #                stderr=subprocess.PIPE)
    #stdout, stderr = process.communicate()
    #stdout, stderr
    relay.off()
    state = 0
    sys.exit(0)





