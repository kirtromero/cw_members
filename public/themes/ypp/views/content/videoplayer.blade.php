@if(isset($type) && isset($video->$type))
<div id="mediaplayer{{ $type }}"></div>

<script src="http://jwpsrv.com/library/rWd1PvF5EeODxCIACyaB8g.js"></script>
<script type="text/javascript">jwplayer.key="McUgwP+K+ItnRWC1beGOYCLtMuZGgA4p8Ameyg==";</script>

@if(is_array($video->$type))
	<script type="text/javascript">
		jwplayer("mediaplayer{{ $type }}").setup({
			'width': "100%",
			'aspectratio':'{{ $video->width }}:{{ $video->height }}',
			'stretching' : "exactfit",
			'playlist' : [
				@foreach($video->$type as $video_file)
					{
						'file': '{{ $video->http_path }}/{{ $type }}/{{ $video_file }}',
						'image': '{{ $video->PlaylistThumb(\YppContent::removeExtension($video_file)."_1.jpg") }}'
					},
				@endforeach
				],
			'listbar': {
				position: "right",
				size: 80
			}
		});
	</script>
@else
	<script type="text/javascript">
		jwplayer("mediaplayer{{ $type }}").setup({
			'width': "100%",
			'aspectratio':'{{ $video->width }}:{{ $video->height }}',
			'file': "{{ $video->http_path }}/{{ $type }}/{{ $video->$type }}",
			'image': "{{ $video->poster }}",
			'stretching' : "exactfit"
		});
	</script>
@endif
@endif
