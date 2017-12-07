/*$("#state").change(event => {
    $.get(`towns/${event.target.value}`, function(res, sta) {
        $("#town").empty();
        res.forEach(element => {
            $("#town").append(`<option value=${element.id}>${element.title}</option>`);
        });
    });
});*/

/*$("#facultades").change(event => {
    $.get('ambienteFacu/${event.target.value}', function(res, sta) {
        console.log(res);

        /*$("#town").empty();
      res.forEach(element => {
        $("#town").append(`<option value=${element.id}>${element.title}</option>`);
    });
    });
});*/

$("#facultades").change(function(event) {
    $.get("ambienteFacu/" + event.target.value + "", function(response, state) {
        $("#ambiente").empty();
        /*console.log(response);*/
        for (i = 0; i < response.length; i++) {
            $("#ambiente").append("<option value='" + response[i].id + "'> " + response[i].title + "</option>");
        }
    });
});
