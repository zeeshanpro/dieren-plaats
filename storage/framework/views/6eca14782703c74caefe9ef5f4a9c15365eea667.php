<?php
$num=(isset($stars)?$stars:1);
$intpart = floor( $num )   ; 
$fraction = $num - $intpart ;
 $blnHalfStar = (($fraction >= 0.5)?true:false);
?>
<?php for($i=1;$i<=5;$i++): ?>
<?php if($i<=$intpart): ?>
 <i class="bi bi-star-fill active" title="Average Rating : <?php echo e($stars??1); ?>" ></i>
 <?php elseif($i==$intpart+1): ?>
  
  <?php if($blnHalfStar): ?>
   <i class="bi bi-star-half active"  title="Average Rating : <?php echo e($stars??1); ?>" ></i>
  <?php else: ?>
   <i class="bi bi-star-fill"  title="Average Rating : <?php echo e($stars??1); ?>" ></i> 
  <?php endif; ?>
  
  <?php else: ?>
    
        <i class="bi bi-star-fill"  title="Average Rating : <?php echo e($stars??1); ?>" ></i> 
    
 <?php endif; ?>

 <?php endfor; ?>

<?php /**PATH C:\xampp7.4\htdocs\dieren-plaats\resources\views/front/layout/components/stars.blade.php ENDPATH**/ ?>