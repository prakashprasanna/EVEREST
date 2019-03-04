function markNotificationAsRead(notificationCount){
     if(notificationCount !== '0'){
     $.get('/ajveverest/dashboard/markAsRead');
     }
}