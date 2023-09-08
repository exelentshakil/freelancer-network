import './bootstrap';
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';
import Swal from 'sweetalert2'


window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true
});

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

window.Echo.private(`job_notification_for_${Laravel.user.role}`)
            .listen('NewJobCreated', (job) => {
                console.log(job)

                Swal.fire({
                    title: 'New Job Posted!',
                    text: job.job.title,
                    icon: 'warning',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, want to place bid!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.replace('http://'+ location.host + '/jobs/' + job.job.permalink)
                    }
                })
            })
