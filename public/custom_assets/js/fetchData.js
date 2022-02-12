  
  // Example POST method implementation:
  async function postData(url = '',token, data = {}) {
    //   console.log(data,JSON.stringify(data))
    const param = {
        method: 'POST',
        mode: 'cors', // no-cors, *cors, same-origin
        cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
        credentials: 'same-origin', // include, *same-origin, omit
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json, text-plain, */*",
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": token,
        },
        credentials: "same-origin",
        redirect: 'follow', // manual, *follow, error
        referrerPolicy: 'no-referrer',
        body: JSON.stringify(data),
        // body:data,

    }
    const response = await fetch(url,param);
    return response;//return always promise
    // .then((response)=>{
    //     // console.log('response1:',response);
    //     // console.log('response.json():',response.json());//return always promise
    //     return response.json();
    // })
    // .then(data=>console.log('success :',data))
    // .catch(error=>console.log('error :',error));
    // return response.json(); // parses JSON response into native JavaScript objects
}