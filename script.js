function ajaxSuccess() {
  // console.log(this.responseText);

  const RESPONSE = JSON.parse(this.responseText);
  if (RESPONSE['form'] === 'transfer-form') {
    document.getElementById('demo1').innerHTML = RESPONSE['errors'];
    document.getElementById('demo2').innerHTML = RESPONSE['subject'];
    document.getElementById('demo3').innerHTML = RESPONSE['messages'];
  } else if (RESPONSE['form'] === 'download-form') {
    document.getElementById('demo1').innerHTML = RESPONSE['message'];
  }
}

function AJAXSubmit(oFormElement) {
  if (!oFormElement.action) {
    return;
  }
  var oReq = new XMLHttpRequest();
  oReq.onload = ajaxSuccess;
  if (oFormElement.method.toLowerCase() === "post") {
    oReq.open("post", oFormElement.action);
    oReq.send(new FormData(oFormElement));
  }
}
