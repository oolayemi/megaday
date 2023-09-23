<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductMediaFile;
use App\Services\Enums\MediaTypeEnum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductMediaFileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductMediaFile::truncate();
        $images = [
            'https://media.istockphoto.com/id/173607126/photo/data-server.jpg?s=612x612&w=0&k=20&c=IMHXEMfjITKWUHoED6tl_TmRhgvdyf7F-vn3Rld8OSk=',
            'https://media.istockphoto.com/id/97891283/photo/high-performance-servers.jpg?s=612x612&w=is&k=20&c=EqtefdHgsXgosBxaiRy6DB0IkhzJXpZmrGgUpt1mN-o=',
            'https://media.istockphoto.com/id/453178171/vector/computer-case-front-and-rear-side.jpg?s=612x612&w=is&k=20&c=3IZ-X7tcF30iJJvhhZuTyGAjDQ31wF1bRTrxoCG6W-w=',
            'https://media.istockphoto.com/id/1177494928/photo/computer-desktop-pc-case.jpg?s=612x612&w=is&k=20&c=hWkC-kz__fa63HLezyoHk7Q_5JE8uHtnDCArBUt120Y=',
            'https://media.istockphoto.com/id/1333490708/vector/water-bottle-icon-vector-illustration-design.jpg?s=612x612&w=0&k=20&c=bzDz5rScrBzFFAqiN5wekIsw8YGwEkZsNHo0ujE3JCg=',
            'https://media.istockphoto.com/id/1324556212/vector/insulated-water-bottle-with-carry-handle-and-carabiner-clip-realistic-vector-mock-up.jpg?s=612x612&w=0&k=20&c=cTKBZKrMHkZWsiPvnuAWOm2DvDwnUFO8TkwDSIorSAE=',
            'https://media.istockphoto.com/id/1423379549/vector/blank-metal-insulated-water-bottle-vector-mockup-reusable-stainless-steel-travel-sport-flask.jpg?s=612x612&w=0&k=20&c=mXeJNB9xF7jh2Q8mGxkuenoyhEcgxdaBx9BaffVDb6k=',
            'https://media.istockphoto.com/id/1331157592/photo/drinking-water-bottle-for-sports-in-female-hand-on-blue-backgraund-with-copy-space-reusable.jpg?s=612x612&w=0&k=20&c=qmZIK8mssOxi0H8AEgjVLnOU0s42jyq-meBKgGQ5mFs=',
            'https://media.istockphoto.com/id/1221024632/photo/stay-hydrated-during-work-from-home-or-office.jpg?s=612x612&w=0&k=20&c=JD07H0Zex1gIzl-dXcQhCNRDyIx7YkSZtC5lWgvCUpE=',
            'https://media.istockphoto.com/id/1150931120/photo/3d-illustration-of-generic-compact-white-car-front-side-view.jpg?s=612x612&w=0&k=20&c=MkM3U9ruXp2wKCgYKeL6DyZ9H5WFIHtyRWsbOMokrFg=',
            'https://media.istockphoto.com/id/1273682054/photo/car-service-worker-applying-nano-coating-on-a-car-detail.jpg?s=612x612&w=0&k=20&c=w2YoGPnv24lcITfiH7jnTYLAj9xCXUrlbHn33lxcd2U=',
            'https://media.istockphoto.com/id/1307086567/photo/generic-modern-suv-car-in-concrete-garage.jpg?s=612x612&w=0&k=20&c=eh6EA4g462zfVg5a3iPwMsbNlTGZqYhZFUhcLoaLDSs=',
            'https://media.istockphoto.com/id/949483148/photo/3d-illustration-of-generic-suv-car-side-view.jpg?s=612x612&w=0&k=20&c=yk8JAOw8pMH3GFhrP2poFNiBQ2msVtLWCiQ-b_gZ0dU=',
            'https://media.istockphoto.com/id/959391798/photo/3d-illustration-of-generic-compact-white-suv.jpg?s=612x612&w=0&k=20&c=2VqUK6i3gs1_ZbYKCEusyjhp-PqakZFsMM7xppqsqeU=',
            'https://media.istockphoto.com/id/1070147706/photo/3d-illustration-of-generic-silver-hatchback-on-white-background.jpg?s=612x612&w=0&k=20&c=Yz8cqZuQo7XACDwSmeXkXa3g4bp9NEWuG2sGg62yVhc=',
            'https://media.istockphoto.com/id/1340571998/photo/man-rides-a-bike-outdoors-in-the-park-on-a-sunny-day-at-sunset.jpg?s=612x612&w=0&k=20&c=X_Hd6qUw_8rUQbgE-N0FlmL2XQsN7WdU2XgTLvAy4u0=',
            'https://media.istockphoto.com/id/1132953037/photo/male-courier-with-bicycle-delivering-packages-in-city-copy-space.jpg?s=612x612&w=0&k=20&c=YC7UEUlYUzDNo3xFiKWAT8zrhHPzjyz0aVyEnC0NMJw=',
            'https://media.istockphoto.com/id/1070233662/photo/yellow-black-racing-sport-road-bike-bicycle-racer-isolated.jpg?s=612x612&w=0&k=20&c=jcW1T5QNjpd_AeUiS8jlFB3_AzJ1u-8hjO0TTabVbV0=',
            'https://media.istockphoto.com/id/1176169958/photo/group-of-cyclist-at-professional-race.jpg?s=612x612&w=0&k=20&c=MUf_tAKY37CmEhtscLNC12UOctWKGXVrFaIS1s3Y2LE=',
            'https://media.istockphoto.com/id/1023428598/photo/3d-illustration-laptop-isolated-on-white-background-laptop-with-empty-space-screen-laptop-at.jpg?s=612x612&w=0&k=20&c=ssK6er5v1fGpSghGiqySwoD8tn5blC7xgefQJI2xU38=',
            'https://media.istockphoto.com/id/1352603244/photo/shot-of-an-unrecognizable-businessman-working-on-his-laptop-in-the-office.jpg?s=612x612&w=0&k=20&c=upiDYeAZEsxbUBdhX35MXm79drIXA-5Q-FcfmZk71lM=',
            'https://media.istockphoto.com/id/1394988455/photo/laptop-with-a-blank-screen-on-a-white-background.jpg?s=612x612&w=0&k=20&c=BXNMs3xZNXP__d22aVkeyfvgJ5T18r6HuUTEESYf_tE=',
            'https://media.istockphoto.com/id/1416048929/photo/woman-working-on-laptop-online-checking-emails-and-planning-on-the-internet-while-sitting-in.jpg?s=612x612&w=0&k=20&c=mt-Bsap56B_7Lgx1fcLqFVXTeDbIOILVjTdOqrDS54s=',
            'https://media.istockphoto.com/id/1297540300/photo/blank-screen-laptop-on-the-table-with-blurred-living-room-background-at-night.jpg?s=612x612&w=0&k=20&c=3hlaGH6B6l3u-o7JWmJaPgjaqCe6YWN6eYpYWUo-cqM=',
            'https://media.istockphoto.com/id/171224469/photo/canvas-shoes.jpg?s=612x612&w=0&k=20&c=oD5A61xxgna-0WNafNcZxySSwCiEnUCs5wiDJVfb2tQ=',
            'https://media.istockphoto.com/id/172417586/photo/elegant-black-leather-shoes.jpg?s=612x612&w=0&k=20&c=c_tTljwbu2m0AGxwb27NxCgG0Y2Cv-C4v8q6V36RYbw=',
            'https://media.istockphoto.com/id/1149654373/photo/creative-minimal-paper-idea-concept-white-shoe-with-white-background-3d-render-3d-illustration.jpg?s=612x612&w=0&k=20&c=Z1sy46GDIY5D7XI-eSvoRRlPmaMjmZpeRvFKNQVQFto=',
            'https://media.istockphoto.com/id/956501428/photo/sport-shoes-on-isolated-white-background.jpg?s=612x612&w=0&k=20&c=BdklqnfGUvf02-2CxYsw-AnrbE3e-B5zhE9JQILEEW4=',
            'https://media.istockphoto.com/id/178716575/photo/mobile-devices.jpg?s=612x612&w=0&k=20&c=9YyINgAbcmjfY_HZe-i8FrLUS43-qZh6Sx6raIc_9vQ=',
            'https://media.istockphoto.com/id/625135580/photo/laptop-disassembling-with-screwdriver-at-repair.jpg?s=612x612&w=0&k=20&c=Em-dB6fevNhRd5yaIxcgjDfFxuTVT4OSm_ys_Ybke6c=',
            'https://media.istockphoto.com/id/1211554164/photo/3d-render-of-home-appliances-collection-set.jpg?s=612x612&w=0&k=20&c=blm3IyPyZo5ElWLOjI-hFMG-NrKQ0G76JpWGyNttF8s=',
            'https://media.istockphoto.com/id/489937474/photo/home-appliances.jpg?s=612x612&w=0&k=20&c=x9MfsuwtJlNhq8uLWOpisy16b9JHfeqqxmeyP4nXoHw=',
            'https://media.istockphoto.com/id/1329491486/photo/yellow-household-appliances-on-yellow-background-set-of-home-technics.jpg?s=612x612&w=0&k=20&c=kyK7KOWHRN8ewnccSZEXuWNiodKxRgXKEI0D5KbxuAk=',
            'https://media.istockphoto.com/id/157569788/photo/kitchen.jpg?s=612x612&w=0&k=20&c=NctazJvffpt2pEOGvmBQmGve8VGWAXiol4kG1PxC3f4=',
            'https://media.istockphoto.com/id/528066480/photo/red-stand-mixer-mixing-cream.jpg?s=612x612&w=0&k=20&c=pvDLhvwtyMi9lvbikDppNZy86O8SxhjTFFW2jrmLsPU=',
            'https://media.istockphoto.com/id/1170073824/photo/gamer-work-space-concept-top-view-a-gaming-gear-mouse-keyboard-joystick-headset-mobile.jpg?s=612x612&w=0&k=20&c=2d8z6CmJn6R1GaPpJ4HB4J43y4e0wOL4nusPM2Dhq34=',
            'https://media.istockphoto.com/id/1329045610/photo/flying-gamer-gears-like-mouse-keyboard-joystick-headset-vr-microphone.jpg?s=612x612&w=0&k=20&c=KmwA5iVYRp0kH77_MMEe09RAaSBLLn7hupvx_wbELuQ=',
            'https://media.istockphoto.com/id/1133856693/photo/modern-office-desk-background-top-view-with-copy-space.jpg?s=612x612&w=0&k=20&c=UX-swQafcKZRHXfYtrUzIHus6oyd7Ur09whyY5WtUEA='
        ];
        Product::get()->each(function (Product $product) use ($images) {
            $product->mediaFiles()->create([
                'path' => $images[rand(1,37)],
                'media_type' =>  MediaTypeEnum::image->name,
                'is_featured' => true,
            ]);
        });
    }
}
