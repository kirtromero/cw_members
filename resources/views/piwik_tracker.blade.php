@if(isset($piwik_tracker_ids) && !empty($piwik_tracker_ids))
<script type="text/javascript" src="{{ config('yppmembers.piwik_url') }}/piwik.js"></script>
<script type="text/javascript">
    
        try {
        	@foreach($piwik_tracker_ids as $pk => $piwik_tracker_id)
            var piwikTracker{{ $pk }} = Piwik.getTracker("{{ config('yppmembers.piwik_url') }}/piwik.php", {{ $piwik_tracker_id }});
            piwikTracker{{ $pk }}.trackPageView();
            @endforeach
        } catch( err ) {}
    
</script>

@endif