var Service = require('node-windows').Service;

// Create a new service object
var svc = new Service({
  name:'AbivaHR Services',
  description: 'Server for chat module',
  script: 'C:\\xampp\\htdocs\\AbivaHR\\server.js'
});

// Listen for the "install" event, which indicates the
// process is available as a service.
svc.on('install',function(){
  svc.start();
});

svc.uninstall();
