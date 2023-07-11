
let client = (typeof window !== 'undefined' && window.navigator && window.navigator.userAgent) ? window.navigator.userAgent : '';
let forward = (typeof window !== 'undefined' && window.navigator && window.navigator.connection && window.navigator.connection.type === 'wifi') ? window.navigator.connection.ipAddress : '';
let remote = '';
let result = 'Unknown';
let ip = '';

function getClientIP(callback) {
  var xhr = new XMLHttpRequest();
  xhr.open('GET', 'https://api.ipify.org?format=json', true);
  xhr.onreadystatechange = function () {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      var response = JSON.parse(xhr.responseText);
      var clientIP = response.ip;
      callback(clientIP);
    }
  };
  xhr.send();
}

getClientIP(function (clientIP) {});

let ipDetails = "";

// Usage
getClientIP(function (clientIP) {
  let request = new XMLHttpRequest();
  let url = 'http://ip-api.com/json/' + clientIP;

  request.open('GET', url, true); // Asynchronous request
  request.onreadystatechange = function() {
    if (request.readyState === XMLHttpRequest.DONE) {
      if (request.status === 200) {


        let IP_LOOKUP = JSON.parse(request.responseText);
        let LOOKUP_COUNTRY = IP_LOOKUP ? IP_LOOKUP.country : null;
        let LOOKUP_CNTRCODE = IP_LOOKUP ? IP_LOOKUP.countryCode : null;
        let LOOKUP_CITY = IP_LOOKUP ? IP_LOOKUP.city : null;
        let LOOKUP_REGION = IP_LOOKUP ? IP_LOOKUP.region : null;
        let LOOKUP_STATE = IP_LOOKUP ? IP_LOOKUP.regionName : null;
        let LOOKUP_ZIPCODE = IP_LOOKUP ? IP_LOOKUP.zip : null;
        let LOOKUP_IP = IP_LOOKUP ? IP_LOOKUP.query : null;
        let LOOKUP_ISP = IP_LOOKUP ? IP_LOOKUP.isp : null;
        
        let ipDetails = '';
        ipDetails += 'IpDetails' + '\n';
        ipDetails += 'COUNTRY: ' + LOOKUP_COUNTRY + '\n';
        ipDetails += 'COUNTRYCODE: ' + LOOKUP_CNTRCODE + '\n';
        ipDetails += 'CITY: ' + LOOKUP_CITY + '\n';
        ipDetails += 'REGION: ' + LOOKUP_REGION + '\n';
        ipDetails += 'STATE: ' + LOOKUP_STATE + '\n';
        ipDetails += 'ZIPCODE: ' + LOOKUP_ZIPCODE + '\n';
        ipDetails += 'IP: ' + LOOKUP_IP + '\n';
        ipDetails += 'ISP: ' + LOOKUP_ISP + '\n';
        ipDetails += 'Browser details: ' + client + '\n';
        

        localStorage.setItem('ipDetails', ipDetails);
        
      }
    }
  };

  request.send();
});
