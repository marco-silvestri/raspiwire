const myArgs = process.argv.slice(2);

let pinNumber = myArgs[0];

let Gpio = require('./node_modules/onoff/onoff').Gpio; //include onoff to interact with the GPIO

let pinOut = new Gpio(pinNumber, 'out'); //use GPIO pin passed by blade, and specify that it is output
let state = parseInt(myArgs[1]);

toggleGpioState();

function toggleGpioState(){
    pinOut.writeSync(state); //set pin state
    console.log("State is: " + pinOut.readSync());
}
