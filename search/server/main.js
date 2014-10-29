var os = require("os");
var cluster = require("cluster");
var io = require("socket.io").listen(9090);
var app = require("./iav.js");
var cores = os.cpus.length;


if(cluster.isMaster)
   {
   	 for (var i = 0; i < cores; i++)
      cluster.fork();
     

  cluster.on("exit", function(worker, code, signal) {
    cluster.fork();
    });

   }


io.sockets.on("connection", function(socket){

   console.log("connected");

    socket.on("search", function(data){

          console.log("data", data);

            var sort = data.sort || {};

            console.log("sort", sort);

    	     app.search(data.filters, function(rs, docs, total, freq,city){                    
    	     	 socket.emit("search", {docs : docs, total : total, city : city, freq:freq});
    	     }, data.page, sort);

    });

});
