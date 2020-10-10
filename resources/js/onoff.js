var Gpio = require('onoff').Gpio; //include onoff to interact with the GPIO
var pinOut = new Gpio(18, 'out'); //use GPIO pin passed by blade, and specify that it is output
var state;
function toggleGpioState(){
    if (pinOut.readSync() === 0){ //check the pin state, if the state is 0 (or off)
        state = 1;
    } else {
        state = 0;
    }
    pinOut.writeSync(state); //set pin state
}