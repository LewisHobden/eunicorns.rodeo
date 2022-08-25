<div class="card-body">
    @if(0 === count($signup->other_signups))
        This player has not signed up for any other days.
    @else
        Other signups: {{ implode(', ',$signup->otherSignupDates()) }}
    @endif
</div>
