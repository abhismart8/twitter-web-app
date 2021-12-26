const tweet = (url, tweet, $this) => {
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
                document.getElementById('tweet-content').value = '';
                setTimeout(function(){
                    window.location.reload();
                }, 1000);
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

const follow = (url, followedId, $this) => {
    axios.post(url, {
        followed_id: followedId,
        follower_id: window.userId
    })
    .then(function (response) {
        if(response.data.status == 'success'){
            $this.html(response.data.key);
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
}