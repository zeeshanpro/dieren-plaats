@php
$num=(isset($stars)?$stars:1);
$intpart = floor( $num )   ; 
$fraction = $num - $intpart ;
 $blnHalfStar = (($fraction >= 0.5)?true:false);
@endphp
@for($i=1;$i<=5;$i++)
@if($i<=$intpart)
 <i class="bi bi-star-fill active" title="Average Rating : {{$stars??1}}" ></i>
 @elseif($i==$intpart+1)
  
  @if($blnHalfStar)
   <i class="bi bi-star-half active"  title="Average Rating : {{$stars??1}}" ></i>
  @else
   <i class="bi bi-star-fill"  title="Average Rating : {{$stars??1}}" ></i> 
  @endif
  
  @else
    
        <i class="bi bi-star-fill"  title="Average Rating : {{$stars??1}}" ></i> 
    
 @endif

 @endfor

