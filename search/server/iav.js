var mongojs = require("mongojs");
var extend = require("./jquery.js");

//garage campo_17 , 
//precio campo_53 arriendo 
//precio campo_5 venta
//baÃ±o campo_9
//habitaciones campo_24
//area campo_6
//antiguedad campo_4

var iav = function(){

	var db = mongojs("iav2", ["inmuebles"]);
	
	this.search = function(filters, callback, page, sort){
 	
		   var limit = limit || 15;
		   var filters = filters || {};		   
		   var page = page || 1;		   
		   	   page = page - 1;  
		   	 filters.estado = "1";	
		   var sort = sort || {};
		    


		    if(sort === "time>")
		    	sort = {campo_4 : -1};
		    if(sort === "time<")
		    	sort = {campo_4 : 1};

		    if(sort === "price>")		    	
		    	sort = {campo_53 : -1, campo_5 : -1};
		    if(sort === "price<")
		    	sort = {campo_53 : 1 , campo_5 : 1};

		    if(sort === "area>")
		    	sort = {campo_6 : -1};
		    if(sort === "area<")
		    	sort = {campo_6 : 1};


		    extend(sort, {num_pics : -1, fields_completed: -1, description_length: -1});
		    console.log(sort);

		   if(filters.campo_6)
		     switch(filters.campo_6){
		     	case 1:
		     	    filters.campo_6 = { $lt : 60};
		     	break;
		     	case 2:
		     	    filters.campo_6 = { $gt : 60 , $lt : 100};
		     	break;
		     	case 3:
		     	    filters.campo_6 = { $gt : 100 , $lt : 200};
		     	break;
		     	case 4:
		     	    filters.campo_6 = { $gt : 200 , $lt : 300};
		     	break;
		     	case 5:
		     	    filters.campo_6 = { $gt : 300 };
		     	break;
		     } 


		     if(filters.campo_5)
		     switch(filters.campo_5){
		     	case 1:
		     	    filters.campo_5 = { $lt : 40000000};
		     	break;
		     	case 2:
		     	    filters.campo_5 = { $gt : 40000000 , $lt : 70000000};
		     	break;
		     	case 3:
		     	    filters.campo_5 = { $gt : 70000000 , $lt : 100000000};
		     	break;
		     	case 4:
		     	    filters.campo_5 = { $gt : 100000000 , $lt : 200000000};
		     	break;
		     	case 5:
		     	    filters.campo_5 = { $gt : 200000000 };
		     	break;
		     } 


		     if(filters.campo_53)
		     switch(filters.campo_53){
		     	case 1:
		     	    filters.campo_53 = { $lt : 300000};
		     	break;
		     	case 2:
		     	    filters.campo_53 = { $gt : 300000 , $lt : 1000000};
		     	break;
		     	case 3:
		     	    filters.campo_53 = { $gt : 1000000 , $lt : 1300000};
		     	break;
		     	case 4:
		     	    filters.campo_53 = { $gt : 1300000 , $lt : 6000000};
		     	break;
		     	case 5:
		     	    filters.campo_53 = { $gt : 6000000 , $lt : 9000000};
		     	break;
		     	case 5:
		     	    filters.campo_53 = { $gt : 9000000 };
		     	break;
		     } 


		       if(filters.campo_24 === 5)		  
		     	    filters.campo_24 = { $gt : 5 };
		       if(filters.campo_9 === 5)		  
		     	    filters.campo_9 = { $gt : 5 };
		     	if(filters.campo_17 === 5)		  
		     	    filters.campo_17 = { $gt : 5 };
		   
		    delete filters["departamento"];

		   console.log(filters);

		   db.inmuebles.find(filters).count(function(err, r){

		   	   var total = r;

		   	db.inmuebles.find(filters).sort(sort).limit(limit).skip( (page * limit), function(err, docs){
		   	  	
		   	  	var docs = docs;		   	  	
		   	  	var _filter = {};
		   	  	_filter.numvisitas = { $gt : 20 };

		   	  	if(filters.ciudad)
		   	  		_filter.ciudad = filters.ciudad;

		   	  	if(filters.tipo_neg)
		   	  		_filter.tipo_neg = filters.tipo_neg;

		   	  db.inmuebles.find( _filter ).limit(10, function(err, rs){
		   	  	console.log("page", page);
		   	  	  callback(err, docs, total, rs, _filter.ciudad, page);
		   	  });
		   	     

		                           });

		   
		   });

	}

};


module.exports = new iav();