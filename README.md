# Raspiwire -  A wannabe web interface to control Raspberry GPIO

Raspwire aims to be a quick, modular and reactive web interface to control appliances connected through the GPIO of your Raspberry via lan or remotely via pivpn.

  - Is developed using the TALL stack (Tailwind CSS, AlpineJS, Laravel, Livewire)
  - It handles the GPIO using the NodeJS module "onoff"
  - It runs on Apache and MySQL

# New Features!

  - Mounting/unmounting of harddisks (paths needs to be specified in the .env)
  - Permanent states saved on a db

### To be added/fixed
   - Usage of Queables to grant an asynchronous behavior
   - CRUD w/ admin access to add/remove/edit the pins and their behaviour
   - Refactoring of the DB to accomodate GPIO customization
   - Classes extensions
   - UI niceties
   
### Installation

Dillinger requires MySQL, Apache, Composer and Node to run.

Install the dependencies, run the migration and fill the DB with your pins.
Serve the folder and access it via brower.

Have fun!

`

### Development

Want to contribute? Great!

All Issues are welcome!

License
----

MIT

**Free Software, Hell Yeah!**

[//]: # (These are reference links used in the body of this note and get stripped out when the markdown processor does its job. There is no need to format nicely because it shouldn't be seen. Thanks SO - http://stackoverflow.com/questions/4823468/store-comments-in-markdown-syntax)


   [laravel]: <https://github.com/laravel/laravel>
   [livewire]: <https://github.com/livewire/livewire>
   [tailwindcss]: <https://tailwindcss.com/>
   [alpinejs]: <https://github.com/alpinejs/alpine>
   [composer]: <https://getcomposer.org/>
   [onoff]: <https://www.npmjs.com/package/onoff>
   [node.js]: <http://nodejs.org>
