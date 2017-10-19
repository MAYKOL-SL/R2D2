
$("#state").change(event =>{   
   $.get(`towns/${event.target.value}`,function(res,sta){     
      $("#town").empty();
      res.forEach(element => {
        $("#town").append(`<option value=${element.id}>${element.nombre_aula}</option>`);     
    }); 
  });
});
		