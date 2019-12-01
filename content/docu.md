###Guide to get the weather by Ip-Address in JSON formate

The API take two arguments: `ip` and `time`.

In order to get the weather you have to provide the information below:

* IP adress, IPv4

Example:
```
weatherjson/weatherCheck?time=past&ip=31.13.72.36
```

If the you enter a valid ip adress you can expect the following response

```
{
    "address": {
        "lat": "56.1621073",
        "long": "15.5866422",
        "city": "Karlskrona",
        "region": "Blekinge l\u00e4n",
        "country": "Sverige"
    },
    "weather_data": {
        "current": [
            {
                "latitude": 56.1621073,
                "longitude": 15.5866422,
                "timezone": "Europe/Stockholm",
                "daily": {
                    "summary": "Regnskurar p\u00e5 tisdag fram till fredag.",
                    "icon": "rain",
                    "data": [
                        {
                            "time": 1574463600,
                            "summary": "Mulet under dagen.",
                            "icon": "cloudy",
                            etc.

                        }
```
