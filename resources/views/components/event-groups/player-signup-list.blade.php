<div class="card-body">
    @if(0 === count($signup->other_signups))
        This player has not signed up for any other days.
    @else
        This player has also signed up for:
        @foreach($signup->other_signups as $signup)
            {{ implode(', ',$signup->otherSignupDates()) }}
        @endforeach
    @endif
</div>
