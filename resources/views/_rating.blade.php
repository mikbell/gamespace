@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/progressbar.js/1.1.0/progressbar.min.js"></script>
<script type="module">
    document.addEventListener('DOMContentLoaded', function () {
        const progressBarContainer = document.getElementById('{{ $slug }}');

        if (progressBarContainer) {
            var bar = new ProgressBar.Circle(progressBarContainer, {
                color: 'white',
                strokeWidth: 6,
                trailWidth: 3,
                trailColor: '#4a5568',
                easing: 'easeInOut',
                duration: 2500,
                text: {
                    autoStyleContainer: false
                },
                from: {
                    color: '#48BB78',
                    width: 6
                },
                to: {
                    color: '#48BB78',
                    width: 6
                },
                step: function(state, circle) {
                    circle.path.setAttribute('stroke', state.color);
                    circle.path.setAttribute('stroke-width', state.width);
                    
                    var value = Math.round(circle.value() * 100);
                    circle.setText(value === 0 ? '0%' : value + '%');
                }
            });

            const rating = {{ $rating }};
            if (rating >= 0 && rating <= 100) {
                bar.animate(rating / 100 );
            } else {
                console.warn('Invalid rating value:', rating);
            }
        } else {
            console.error('Progress bar container not found for slug:', '{{ $slug }}');
        }
    });
</script>
@endpush
