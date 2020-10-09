from gpiozero import OutputDevice
from time import sleep
from sys import exit
import subprocess
import sqlite3

pin = 18

while True:
    connection = sqlite3.connect("rpidb")
    cursor = connection.cursor()
    cursor.execute("SELECT state FROM gpios WHERE gpio_number = "pin";")
    results = cursor.fetchall()
    for r in results:
        state = r
    cursor.close()
    connection.close()

    relay = OutputDevice(18, active_high=state, initial_value=None)

    if state == 1:
        relay.on()
        #sleep(10)
        #nasMount = subprocess.Popen(['mount /dev/sda2 /server_mount/nas', 'More output'],
                        #stdout=subprocess.PIPE, 
                        #stderr=subprocess.PIPE)
        #stdout, stderr = process.communicate()
        #stdout, stderr
        #sys.exit(1)
    elif state == 0:
        #sleep(10)
        #nasMount = subprocess.Popen(['umount /dev/sda2 /server_mount/nas', 'More output'],
        #                stdout=subprocess.PIPE, 
        #                stderr=subprocess.PIPE)
        #stdout, stderr = process.communicate()
        #stdout, stderr
        relay.off()
        #sys.exit(0)
    sleep(5)




