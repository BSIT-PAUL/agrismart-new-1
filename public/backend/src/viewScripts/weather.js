const apiKey = "6b0f8e0e06a446518ce6a060073a6f17";
const apiUrl = "https://api.openweathermap.org/data/2.5/weather?&units=metric";
var address = $( "#address" ).val();
console.log(address);
async  function getWeather(city){

    const response = await fetch(apiUrl + `&appid=${apiKey}` + + `&q=${city}`);
    var data = await response.json();

    // console.losg(data);

    $('#city').html(data.name);
    $('#temp').html(data.main.temp + "°C");
    $("#humid").html(data.main.humidity+"%");
    $("#wind").html(data.wind.speed+"km/h");
}
