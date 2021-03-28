<ul class="list-group list-group-flush list my--3">
    <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li class="list-group-item px-0">
            <div class="row align-items-center">
                <div class="col-auto">
                    <a href="#" class="avatar rounded-circle">
                        <img alt="Image placeholder" src="<?php echo e(asset(Storage::url('uploads/plan')).'/'.$plan->image); ?>">
                    </a>
                </div>
                <div class="col ml--2">
                    <h4 class="mb-0">
                        <a href="#!"><?php echo e($plan->name); ?></a>
                    </h4>
                    <small> <?php echo e(\Auth::user()->priceFormat($plan->price)); ?> <?php echo e(' / '. $plan->duration); ?></small>
                </div>
                <div class="col ml--2">
                    <h4 class="mb-0">
                        <a href="#!"><?php echo e(__('Employees')); ?></a>
                    </h4>
                    <small> <?php echo e($plan->max_employee); ?></small>
                </div>
                <div class="col ml--2">
                    <h4 class="mb-0">
                        <a href="#!"><?php echo e(__('Clients')); ?></a>
                    </h4>
                    <small> <?php echo e($plan->max_client); ?></small>
                </div>
                <div class="col-auto">
                    <?php if($user->plan==$plan->id): ?>
                        <div class="media-value"></div>
                        <div class="media-label text-success"><h5><?php echo e(__('Active')); ?></h5></div>
                    <?php else: ?>
                        <div class="media-value">
                            <a href="<?php echo e(route('plan.active',[$user->id,$plan->id])); ?>" class="btn btn-primary btn-sm" title="Click to Upgrade Plan"><i class="fas fa-cart-plus"></i></a>
                        </div>
                        <div class="media-label text-success"><h6></h6></div>
                    <?php endif; ?>

                </div>
            </div>
        </li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>
<?php /**PATH C:\wamp64\www\products-temp\growcrm\resources\views/user/plan.blade.php ENDPATH**/ ?>