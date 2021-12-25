const tweet = (url, tweet) => {
    console.log(tweet);
    if(tweet != ''){
        axios.post(url, {
            content: tweet,
            user_id: window.userId
        })
        .then(function (response) {
            if(response.data.status == 'success'){
                iziToast.success({
                    message: response.data.message,
                });
            }else{
                iziToast.error({
                    message: response.data.message,
                });
            }
        })
        .catch(function (err) {
            console.log(err)
        })
    }else{
        let message = '';
        if(tweet == ''){
            message += 'Please enter the tweet.';
        }
        iziToast.error({
            message: message,
        });
    }
}