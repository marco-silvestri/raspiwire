const myArgs = process.argv.slice(2);

let pinNumber = myArgs[0];

let Gpio = require('./node_modules/onoff/onoff').Gpio; //include onoff to interact with the GPIO

let pinOut = new Gpio(pinNumber, 'out'); //use GPIO pin passed by blade, and specify that it is output
let state = myArgs[1];

function toggleGpioState(){
    if (pinOut.readSync() === 0){ //check the pin state, if the state is 0 (or off)
        state = 1;
    } else {
        state = 0;
    }
    pinOut.writeSync(state); //set pin state
}