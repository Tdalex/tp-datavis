$(document).ready(function(){
	// Pas de cache sur les requête IMPORTANT !
	$.ajaxSetup({ cache: false });
	
	/*** 
		On définit ici les fonctions de base qui vont nous servir à la récupération des données
		Je ne définis que le GET ici, mais il est possible d'utiliser POST pour récupérer ses données (on le verra dans un prochain TP)
	****/
	function getRequest(url, callback) {
		$.get(url, function(data) {
			data = $.parseJSON(data);
			callback(data);
		});
	}
	
	var h = 300;
	var w = 800;		
	
	function generateListeAmis(url, idDivToFill) { 
		getRequest(url, function(dataset) {
			var xScale = d3.scale.linear()
				.domain([0, 35])
				.range([0, w]);
				
			var yScale = d3.scale.linear()
				.domain([0, d3.max(dataset, function(d) {return d[1]+5;})])
				.range([h-24, 0]);
			
			var xAxis = d3.svg.axis()
				.scale(xScale)
				.orient('bottom');
				
			var yAxis = d3.svg.axis()
				.scale(yScale)
				.orient('left');
				
			var	svg = d3.select("#"+idDivToFill)
			.append("svg")
			.attr('height', h)
			.attr('width', w);
			
			svg
			.selectAll("circle")
			.data(dataset)
			.enter()	
			.append("circle")
			.attr('cx', function(d){ return xScale(parseInt(d[2].substring(8,11))+1);})
			.attr('cy', function(d){ return yScale(d[1]);})
			.attr('r', 5);
			
			svg
			.selectAll("text")
			.data(dataset)
			.enter()	
			.append("text")
			.text(function(d){
				return d[1] + ', ' + d[2];
			})
			.attr('x', function(d){ return xScale(parseInt(d[2].substring(8,11)));})
			.attr('y', function(d){ return yScale(d[1]-3);});
			
			svg
			.append("text")
			.attr("class", "x label")
			.attr("text-anchor", "end")
			.attr("x", w -10)
			.attr("y", h - 23)
			.text("jour du mois");
			
			svg
			.append("text")
			.attr("class", "y label")
			.attr("text-anchor", "end")
			.attr("y", 25)
			.attr("dy", ".75em")
			.attr("transform", "rotate(-90)")
			.text("nombre d'amis");
			
			svg
			.append('g')
			.attr('transform', "translate(25," + (h-20) + ")")
			.call(xAxis);
			
			svg
			.append('g')
			.attr('transform', "translate(25,10)")
			.call(yAxis);
		});
	}
	
	function generatePopularity(url) { 
		getRequest(url, function(dataset) {
			var xScale = d3.scale.linear()
				.domain([0, 35])
				.range([0, w]);
				
			var yScale = d3.scale.linear()
				.domain([0, 5])
				.range([h-24, 0]);
			
			var xAxis = d3.svg.axis()
				.scale(xScale)
				.orient('bottom');
						
			var yAxis = d3.svg.axis()
				.scale(yScale)
				.orient('left');
				
			d3.select("svg")
			.selectAll("svg")
			.data(dataset)
			.enter()	
			.append("circle")
			.attr('cx', function(d){ return xScale(parseInt(d[3].substring(8,11))+1);})
			.attr('cy', function(d){ return yScale(d[2]);})
			.attr('r', 5)
			.style("fill", "red");
			
			d3.select("svg")
			.selectAll("svg")
			.data(dataset)
			.enter()	
			.append("text")
			.text(function(d){
				return d[2] + ', ' + d[3];
			})
			.attr('x', function(d){ return xScale(parseInt(d[3].substring(8,11))+0.5);})
			.attr('y', function(d){ return yScale(d[2]-0.3);})
			.style("fill", "red");
			
			d3.select("svg")
			.append("text")
			.attr("class", "y label")
			.attr("text-anchor", "end")
			.attr("y", 750)
			.attr("dy", ".75em")
			.attr("transform", "rotate(-90)")
			.text("popularité")
			.style("fill", "red");
			
			d3.select("svg")
			.append('g')
			.attr('transform', "translate(800,10)")
			.call(yAxis)
			.style("fill", "red");
		});	
	}
	
	/***************************************
		QUESTION 1
	****************************************/
	generateListeAmis("webservices/liste_amis_user?user="+user, "listeAmis");
	generatePopularity("webservices/notations_user?user="+user);
})