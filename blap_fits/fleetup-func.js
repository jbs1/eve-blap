var doctrine_list=[36574,36572,36573];//talware,vexor+aug,caracal+osprey


$(function(){
	for (var i = 0; i < doctrine_list.length; i++) {
		var json=$.getJSON("https://api.fleet-up.com/Api.svc/"+app_key+"/"+userid+"/"+api_code+"/DoctrineFittings/"+doctrine_list[i]);
		console.log(json);
	}

})