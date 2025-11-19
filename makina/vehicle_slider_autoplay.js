        <?php foreach($latestVehicles as $vehicle): ?>
            <?php if(!empty($vehicle['images']) && count($vehicle['images'])>1): ?>
                new Swiper('.vehicle-swiper-<?php echo $vehicle['id']; ?>',{
                    loop:true,
                    autoplay:{
                        delay:3000,
                        disableOnInteraction:false,
                        pauseOnMouseEnter:true
                    },
                    speed:800,
                    pagination:{
                        el:'.vehicle-swiper-<?php echo $vehicle['id']; ?> .swiper-pagination',
                        clickable:true
                    },
                    navigation:{
                        nextEl:'.vehicle-swiper-<?php echo $vehicle['id']; ?> .swiper-button-next',
                        prevEl:'.vehicle-swiper-<?php echo $vehicle['id']; ?> .swiper-button-prev'
                    }
                });
            <?php endif; ?>
        <?php endforeach; ?>
