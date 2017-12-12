var doctrine_list=[36574,36572,36573];//talware,vexor+aug,caracal+osprey
var doctrine_return=new Object();

/*Fleetup-Slots:
1 - Ship (Type/Name)
2 - Low
3 - Medium
4 - High
5 - SubSystem
6 - Rig
7 - Drone
8 - Cargo
*/

$(function(){
	var async_count=0;
	for (var i = 0; i < doctrine_list.length; i++) {
		var link = "http://api.fleet-up.com/Api.svc/"+app_key+"/"+userid+"/"+api_code+"/DoctrineFittings/"+doctrine_list[i]+"/true";
		var cors_link = "https://cors-anywhere.herokuapp.com/"+link;//hotfix for https and cors proxy

		$.ajax({
			url: cors_link,
			type: 'GET',
		})
		.done(function(data) {
			for(key in data.Data){
				if(data.Data[key].EveTypeId in doctrine_return){
					doctrine_return[data.Data[key].EveTypeId].push(data.Data[key].FittingData);
				} else {
					doctrine_return[data.Data[key].EveTypeId] = [data.Data[key].FittingData];
				}
			}
			if(async_count==doctrine_list.length-1){
				print_test();
			} else {
				async_count++;
			}
		});
	}

	function print_test(){
		console.log(doctrine_return);
	}
});

