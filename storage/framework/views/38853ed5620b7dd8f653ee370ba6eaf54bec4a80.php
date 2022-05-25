<div class="row my-3">
    <ul class="nav nav-pills">
        <?php $__currentLoopData = $nav_house; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nav): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <li class="nav-item" style="font-size: 0.95rem; font-weight: bold;">
                <a class="nav-link <?php echo e($nav['is_active']); ?>" href="<?php echo e($nav['pageurl']); ?>"><?php echo e($nav['pagename']); ?></a>
            </li>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</div>
<?php /**PATH F:\Projects\LaravelProject\Rento\System\rento\resources\views/layouts/nav_house.blade.php ENDPATH**/ ?>