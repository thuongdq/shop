<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        Uncategorized - 1
        Category::create([
            'name' => 'Uncategorized',
            'slug' => 'uncategorized',
            'order' => 0,
            'parent' => 0
        ]);
//        factory(Category::class, 50)->create();

//        Tin Tức - 2
        $news = Category::create([
            'name' => 'Tin Tức',
            'slug' => str_slug('Tin Tức'),
            'order' => 1,
            'parent' => 0
        ]);

//        Sự kiện - 3
        Category::create([
            'name' => 'Sự kiện',
            'slug' => str_slug('Sự kiện'),
            'order' => 0,
            'parent' => $news->id
        ]);

//        Xã hội - 4
        $society = Category::create([
            'name' => 'Xã hội',
            'slug' => str_slug('Xã hội'),
            'order' => 1,
            'parent' => $news->id
        ]);

//        Chính trị - 5
        Category::create([
            'name' => 'Chính trị',
            'slug' => str_slug('Chính trị'),
            'order' => 0,
            'parent' => $society->id
        ]);

//        Phóng sự-Ký sự - 6
        Category::create([
            'name' => 'Phóng sự-Ký sự',
            'slug' => str_slug('Phóng sự-Ký sự'),
            'order' => 1,
            'parent' => $society->id
        ]);

//        Giao thông - 7
        Category::create([
            'name' => 'Giao thông',
            'slug' => str_slug('Giao thông'),
            'order' => 2,
            'parent' => $society->id
        ]);

//        Môi trường - 8
        Category::create([
            'name' => 'Môi trường',
            'slug' => str_slug('Môi trường'),
            'order' => 3,
            'parent' => $society->id
        ]);

//        Hồ sơ - 9
        Category::create([
            'name' => 'Hồ sơ',
            'slug' => str_slug('Hồ sơ'),
            'order' => 4,
            'parent' => $society->id
        ]);

//        Thế giới - 10
        $world = Category::create([
            'name' => 'Thế giới',
            'slug' => str_slug('Thế giới'),
            'order' => 2,
            'parent' => $news->id
        ]);

//        Châu Á - 11
        Category::create([
            'name' => 'Châu Á',
            'slug' => str_slug('Châu Á'),
            'order' => 0,
            'parent' => $world->id
        ]);

//        EU & Nga - 12
        Category::create([
            'name' => 'EU & Nga',
            'slug' => str_slug('EU & Nga'),
            'order' => 1,
            'parent' => $world->id
        ]);

//        Châu Mỹ - 13
        Category::create([
            'name' => 'Châu Mỹ',
            'slug' => str_slug('Châu Mỹ'),
            'order' => 2,
            'parent' => $world->id
        ]);

//        Điểm nóng - 14
        Category::create([
            'name' => 'Điểm nóng',
            'slug' => str_slug('Điểm nóng'),
            'order' => 3,
            'parent' => $world->id
        ]);

//        Kiều bào - 15
        Category::create([
            'name' => 'Kiều bào',
            'slug' => str_slug('Kiều bào'),
            'order' => 4,
            'parent' => $world->id
        ]);

//        Tư liệu - 16
        Category::create([
            'name' => 'Tư liệu',
            'slug' => str_slug('Tư liệu'),
            'order' => 5,
            'parent' => $world->id
        ]);

//        Sức mạng số - 17
        $technology = Category::create([
            'name' => 'Sức mạng số',
            'slug' => str_slug('Sức mạng số'),
            'order' => 3,
            'parent' => $news->id
        ]);

//        Máy tính - Mạng - 18
        Category::create([
            'name' => 'Máy tính - Mạng',
            'slug' => str_slug('Máy tính - Mạng'),
            'order' => 0,
            'parent' => $technology->id
        ]);

//        Di động - Viễn thông - 19
        Category::create([
            'name' => 'Di động - Viễn thông',
            'slug' => str_slug('Di động - Viễn thông'),
            'order' => 1,
            'parent' => $technology->id
        ]);

//        Điện tử tiêu dùng - 20
        Category::create([
            'name' => 'Điện tử tiêu dùng',
            'slug' => str_slug('Điện tử tiêu dùng'),
            'order' => 2,
            'parent' => $technology->id
        ]);

//        Nghe nhìn - 21
        Category::create([
            'name' => 'Nghe nhìn',
            'slug' => str_slug('Nghe nhìn'),
            'order' => 3,
            'parent' => $technology->id
        ]);

//        Phần mềm - Bảo mật -22
        Category::create([
            'name' => 'Phần mềm - Bảo mật',
            'slug' => str_slug('Phần mềm - Bảo mật'),
            'order' => 4,
            'parent' => $technology->id
        ]);

//        Thủ thuật - Mẹo vặt - 23
        Category::create([
            'name' => 'Thủ thuật - Mẹo vặt',
            'slug' => str_slug('Thủ thuật - Mẹo vặt'),
            'order' => 5,
            'parent' => $technology->id
        ]);

//        Thị trường công nghệ - 24
        Category::create([
            'name' => 'Thị trường công nghệ',
            'slug' => str_slug('Thị trường công nghệ'),
            'order' => 6,
            'parent' => $technology->id
        ]);

//        Sức khoẻ - 25
        $health = Category::create([
            'name' => 'Sức khoẻ',
            'slug' => str_slug('Sức khoẻ'),
            'order' => 4,
            'parent' => $news->id
        ]);

//        Kiến thức giới tính - 26
        Category::create([
            'name' => 'Kiến thức giới tính',
            'slug' => str_slug('Kiến thức giới tính'),
            'order' => 0,
            'parent' => $health->id
        ]);

//        Tư vấn - 27
        Category::create([
            'name' => 'Tư vấn',
            'slug' => str_slug('Tư vấn'),
            'order' => 1,
            'parent' => $health->id
        ]);

//        Làm đẹp - 28
        Category::create([
            'name' => 'Làm đẹp',
            'slug' => str_slug('Làm đẹp'),
            'order' => 2,
            'parent' => $health->id
        ]);

//        Thể thao - 29
        $sport = Category::create([
            'name' => 'Thể thao',
            'slug' => str_slug('Thể thao'),
            'order' => 5,
            'parent' => $news->id
        ]);

//        Thể thao trong nước - 30
        Category::create([
            'name' => 'Thể thao trong nước',
            'slug' => str_slug('Thể thao trong nước'),
            'order' => 0,
            'parent' => $sport->id
        ]);

//        Thể thao quốc tế - 31
        Category::create([
            'name' => 'Thể thao quốc tế',
            'slug' => str_slug('Thể thao quốc tế'),
            'order' => 1,
            'parent' => $sport->id
        ]);

//        Bóng đá trong nước - 32
        Category::create([
            'name' => 'Bóng đá trong nước',
            'slug' => str_slug('Bóng đá trong nước'),
            'order' => 2,
            'parent' => $sport->id
        ]);

//        Châu Âu - 33
        Category::create([
            'name' => 'Châu Âu',
            'slug' => str_slug('Châu Âu'),
            'order' => 3,
            'parent' => $sport->id
        ]);

//        Bóng đá Anh - 34
        Category::create([
            'name' => 'Bóng đá Anh',
            'slug' => str_slug('Bóng đá Anh'),
            'order' => 4,
            'parent' => $sport->id
        ]);

//        Bóng đá TBN - 35
        Category::create([
            'name' => 'Bóng đá TBN',
            'slug' => str_slug('Bóng đá TBN'),
            'order' => 5,
            'parent' => $sport->id
        ]);

//        Tennis - 36
        Category::create([
            'name' => 'Tennis',
            'slug' => str_slug('Tennis'),
            'order' => 6,
            'parent' => $sport->id
        ]);

//        Cờ vua - 37
        Category::create([
            'name' => 'Cờ vua',
            'slug' => str_slug('Cờ vua'),
            'order' => 6,
            'parent' => $sport->id
        ]);

//        Giáo dục - 38
        $education = Category::create([
            'name' => 'Giáo dục',
            'slug' => str_slug('Giáo dục'),
            'order' => 6,
            'parent' => $news->id
        ]);

//        Tin tuyển sinh - 39
        Category::create([
            'name' => 'Tin tuyển sinh',
            'slug' => str_slug('Tin tuyển sinh'),
            'order' => 0,
            'parent' => $education->id
        ]);

//        Khuyến học - 40
        Category::create([
            'name' => 'Khuyến học',
            'slug' => str_slug('Khuyến học'),
            'order' => 1,
            'parent' => $education->id
        ]);

//        Gương sáng - 41
        Category::create([
            'name' => 'Gương sáng',
            'slug' => str_slug('Gương sáng'),
            'order' => 2,
            'parent' => $education->id
        ]);

//        IELTS cùng Scots - 42
        Category::create([
            'name' => 'IELTS cùng Scots',
            'slug' => str_slug('IELTS cùng Scots'),
            'order' => 3,
            'parent' => $education->id
        ]);


//        Du học - 43
        Category::create([
            'name' => 'Du học',
            'slug' => str_slug('Du học'),
            'order' => 4,
            'parent' => $education->id
        ]);

//        Kinh doanh - 44
        $business = Category::create([
            'name' => 'Kinh doanh',
            'slug' => str_slug('Kinh doanh'),
            'order' => 7,
            'parent' => $news->id
        ]);

//        Tài chính - Đầu tư - 45
        Category::create([
            'name' => 'Tài chính - Đầu tư',
            'slug' => str_slug('Tài chính - Đầu tư'),
            'order' => 0,
            'parent' => $business->id
        ]);

//        Thị trường - 46
        Category::create([
            'name' => 'Thị trường',
            'slug' => str_slug('Thị trường'),
            'order' => 1,
            'parent' => $business->id
        ]);

//        Doanh nghiệp - 47
        Category::create([
            'name' => 'Doanh nghiệp',
            'slug' => str_slug('Doanh nghiệp'),
            'order' => 2,
            'parent' => $business->id
        ]);

//        Khởi nghiệp - 48
        Category::create([
            'name' => 'Khởi nghiệp',
            'slug' => str_slug('Khởi nghiệp'),
            'order' => 3,
            'parent' => $business->id
        ]);

//        Bảo vệ NTD - 49
        Category::create([
            'name' => 'Bảo vệ NTD',
            'slug' => str_slug('Bảo vệ NTD'),
            'order' => 4,
            'parent' => $business->id
        ]);

//        Quốc tế - 50
        Category::create([
            'name' => 'Quốc tế',
            'slug' => str_slug('Quốc tế'),
            'order' => 5,
            'parent' => $business->id
        ]);

//        Nhà đất - 51
        Category::create([
            'name' => 'Nhà đất',
            'slug' => str_slug('Nhà đất'),
            'order' => 5,
            'parent' => $business->id
        ]);

//        Văn hoá - 52
        $cultural = Category::create([
            'name' => 'Văn hoá',
            'slug' => str_slug('Văn hoá'),
            'order' => 8,
            'parent' => $news->id
        ]);

//        Đời sống văn hóa - 53
        Category::create([
            'name' => 'Đời sống văn hóa',
            'slug' => str_slug('Đời sống văn hóa'),
            'order' => 0,
            'parent' => $cultural->id
        ]);

//        Sân khấu - Dân gian - 54
        Category::create([
            'name' => 'Sân khấu - Dân gian',
            'slug' => str_slug('Sân khấu - Dân gian'),
            'order' => 1,
            'parent' => $cultural->id
        ]);

//        Du lịch - Khám phá - 55
        Category::create([
            'name' => 'Du lịch - Khám phá',
            'slug' => str_slug('Du lịch - Khám phá'),
            'order' => 2,
            'parent' => $cultural->id
        ]);

//        Văn học - 56
        Category::create([
            'name' => 'Văn học',
            'slug' => str_slug('Văn học'),
            'order' => 3,
            'parent' => $cultural->id
        ]);

//        Điện ảnh - 57
        Category::create([
            'name' => 'Điện ảnh',
            'slug' => str_slug('Điện ảnh'),
            'order' => 4,
            'parent' => $cultural->id
        ]);

//        Âm nhạc - 58
        Category::create([
            'name' => 'Âm nhạc',
            'slug' => str_slug('Âm nhạc'),
            'order' => 5,
            'parent' => $cultural->id
        ]);
//        Nhịp sống trẻ - 59
        $teen = Category::create([
            'name' => 'Nhịp sống trẻ',
            'slug' => str_slug('Nhịp sống trẻ'),
            'order' => 9,
            'parent' => $news->id
        ]);

//        Người Việt trẻ - 60
        Category::create([
            'name' => 'Người Việt trẻ',
            'slug' => str_slug('Người Việt trẻ'),
            'order' => 0,
            'parent' => $teen->id
        ]);

//        Phóng sự trẻ - 61
        Category::create([
            'name' => 'Phóng sự trẻ',
            'slug' => str_slug('Phóng sự trẻ'),
            'order' => 1,
            'parent' => $teen->id
        ]);


//        Xe++ - 62
        $vehicles = Category::create([
            'name' => 'Xe++',
            'slug' => str_slug('Ô tô - xe máy'),
            'order' => 10,
            'parent' => $news->id
        ]);

//        Thị trường xe - 63
        Category::create([
            'name' => 'Thị trường xe',
            'slug' => str_slug('Thị trường xe'),
            'order' => 0,
            'parent' => $vehicles->id
        ]);

//        Văn hoá xe - 64
        Category::create([
            'name' => 'Văn hoá xe',
            'slug' => str_slug('Văn hoá xe'),
            'order' => 1,
            'parent' => $vehicles->id
        ]);

//        Tư vấn xe - 65
        Category::create([
            'name' => 'Tư vấn xe',
            'slug' => str_slug('Tư vấn xe'),
            'order' => 2,
            'parent' => $vehicles->id
        ]);

//        Đua xe - 66
        Category::create([
            'name' => 'Đua xe',
            'slug' => str_slug('Đua xe'),
            'order' => 3,
            'parent' => $vehicles->id
        ]);

//        Giá xe - 67
        Category::create([
            'name' => 'Giá xe',
            'slug' => str_slug('Giá xe'),
            'order' => 4,
            'parent' => $vehicles->id
        ]);

//        Tình yêu - 68
        $love = Category::create([
            'name' => 'Tình yêu',
            'slug' => str_slug('Tình yêu - Giới tính'),
            'order' => 11,
            'parent' => $news->id
        ]);

//        Gia đình - 69
        Category::create([
            'name' => 'Gia đình',
            'slug' => str_slug('Gia đình'),
            'order' => 0,
            'parent' => $love->id
        ]);

//        Góc tâm hồn - 70
        Category::create([
            'name' => 'Góc tâm hồn',
            'slug' => str_slug('Góc tâm hồn'),
            'order' => 1,
            'parent' => $love->id
        ]);

//        Tình yêu - 71
        Category::create([
            'name' => 'Tình yêu',
            'slug' => str_slug('Tình yêu'),
            'order' => 2,
            'parent' => $love->id
        ]);

//        Du lịch - 72
        Category::create([
            'name' => 'Du lịch',
            'slug' => str_slug('Du lịch'),
            'order' => 12,
            'parent' => $news->id
        ]);

//        Pháp luật - 73
        Category::create([
            'name' => 'Pháp luật',
            'slug' => str_slug('Pháp luật'),
            'order' => 13,
            'parent' => $news->id
        ]);

//        Chuyện lạ - 74
        Category::create([
            'name' => 'Chuyện lạ',
            'slug' => str_slug('Chuyện lạ'),
            'order' => 14,
            'parent' => $news->id
        ]);

//        Giải trí - 75
        $relax = Category::create([
            'name' => 'Giải trí',
            'slug' => str_slug('Giải trí'),
            'order' => 15,
            'parent' => $news->id
        ]);

//        Sao Việt - 76
        Category::create([
            'name' => 'Sao Việt',
            'slug' => str_slug('Sao Việt'),
            'order' => 0,
            'parent' => $relax->id
        ]);

//        Hollywood - 77
        Category::create([
            'name' => 'Hollywood',
            'slug' => str_slug('Hollywood'),
            'order' => 1,
            'parent' => $relax->id
        ]);

//        Châu Á - 78
        Category::create([
            'name' => 'Châu Á',
            'slug' => str_slug('Giải trí Châu Á'),
            'order' => 2,
            'parent' => $relax->id
        ]);

//        Thời trang - 79
        Category::create([
            'name' => 'Thời trang',
            'slug' => str_slug('Thời trang'),
            'order' => 3,
            'parent' => $relax->id
        ]);

//        Xem - Ăn - Chơi - 80
        Category::create([
            'name' => 'Xem - Ăn - Chơi',
            'slug' => str_slug('Xem - Ăn - Chơi'),
            'order' => 4,
            'parent' => $relax->id
        ]);

//        Điện thoại - 81
        $mobile = Category::create([
            'name' => 'Điện thoại',
            'slug' => str_slug('Điện thoại'),
            'order' => 2,
            'parent' => 0
        ]);

        Category::create([
            'name' => 'Điện thoại Apple',
            'slug' => str_slug('Điện thoại Apple'),
            'order' => 0,
            'parent' => $mobile->id
        ]);

        Category::create([
            'name' => 'Điện thoại Samsung',
            'slug' => str_slug('Điện thoại Samsung'),
            'order' => 1,
            'parent' => $mobile->id
        ]);

        Category::create([
            'name' => 'Điện thoại HTC',
            'slug' => str_slug('Điện thoại HTC'),
            'order' => 2,
            'parent' => $mobile->id
        ]);

        Category::create([
            'name' => 'Điện thoại LG',
            'slug' => str_slug('Điện thoại LG'),
            'order' => 3,
            'parent' => $mobile->id
        ]);

        Category::create([
            'name' => 'Điện thoại Sony',
            'slug' => str_slug('Điện thoại Sony'),
            'order' => 4,
            'parent' => $mobile->id
        ]);

        Category::create([
            'name' => 'Điện thoại Sky',
            'slug' => str_slug('Điện thoại Sky'),
            'order' => 5,
            'parent' => $mobile->id
        ]);

        Category::create([
            'name' => 'Điện thoại Mobell',
            'slug' => str_slug('Điện thoại Mobell'),
            'order' => 6,
            'parent' => $mobile->id
        ]);

        Category::create([
            'name' => 'Điện thoại OPPO',
            'slug' => str_slug('Điện thoại OPPO'),
            'order' => 7,
            'parent' => $mobile->id
        ]);

        Category::create([
            'name' => 'Điện thoại Xiaomi',
            'slug' => str_slug('Điện thoại Xiaomi'),
            'order' => 8,
            'parent' => $mobile->id
        ]);

        Category::create([
            'name' => 'Điện thoại Lenovo',
            'slug' => str_slug('Điện thoại Lenovo'),
            'order' => 9,
            'parent' => $mobile->id
        ]);

        Category::create([
            'name' => 'Điện thoại FPT',
            'slug' => str_slug('Điện thoại FPT'),
            'order' => 10,
            'parent' => $mobile->id
        ]);

        Category::create([
            'name' => 'Điện thoại Blackberry',
            'slug' => str_slug('Điện thoại Blackberry'),
            'order' => 11,
            'parent' => $mobile->id
        ]);

        Category::create([
            'name' => 'Điện thoại Motorola',
            'slug' => str_slug('Điện thoại Motorola'),
            'order' => 12,
            'parent' => $mobile->id
        ]);

        Category::create([
            'name' => 'Điện thoại Huawei',
            'slug' => str_slug('Điện thoại Huawei'),
            'order' => 13,
            'parent' => $mobile->id
        ]);

        Category::create([
            'name' => 'Điện thoại Vivo',
            'slug' => str_slug('Điện thoại Vivo'),
            'order' => 14,
            'parent' => $mobile->id
        ]);

        Category::create([
            'name' => 'Điện thoại W - Mobile',
            'slug' => str_slug('Điện thoại W - Mobile'),
            'order' => 15,
            'parent' => $mobile->id
        ]);

        Category::create([
            'name' => 'Điện thoại OBI',
            'slug' => str_slug('Điện thoại OBI'),
            'order' => 16,
            'parent' => $mobile->id
        ]);

        Category::create([
            'name' => 'Điện thoại ZTE',
            'slug' => str_slug('Điện thoại ZTE'),
            'order' => 17,
            'parent' => $mobile->id
        ]);

        Category::create([
            'name' => 'Điện thoại Intex',
            'slug' => str_slug('Điện thoại Intex'),
            'order' => 18,
            'parent' => $mobile->id
        ]);

//        Máy tính bảng - 101
        $tablet = Category::create([
            'name' => 'Máy tính bảng',
            'slug' => str_slug('Máy tính bảng'),
            'order' => 3,
            'parent' => 0
        ]);

        Category::create([
            'name' => 'Máy tính bảng Apple',
            'slug' => str_slug('Máy tính bảng Apple'),
            'order' => 0,
            'parent' => $tablet->id
        ]);

        Category::create([
            'name' => 'Máy tính bảng Samsung',
            'slug' => str_slug('Máy tính bảng Samsung'),
            'order' => 1,
            'parent' => $tablet->id
        ]);

        Category::create([
            'name' => 'Máy tính bảng HTC',
            'slug' => str_slug('Máy tính bảng HTC'),
            'order' => 2,
            'parent' => $tablet->id
        ]);

        Category::create([
            'name' => 'Máy tính bảng LG',
            'slug' => str_slug('Máy tính bảng LG'),
            'order' => 3,
            'parent' => $tablet->id
        ]);

        Category::create([
            'name' => 'Máy tính bảng Xiaomi',
            'slug' => str_slug('Máy tính bảng Xiaomi'),
            'order' => 4,
            'parent' => $tablet->id
        ]);

        Category::create([
            'name' => 'Máy tính bảng Asus',
            'slug' => str_slug('Máy tính bảng Asus'),
            'order' => 5,
            'parent' => $tablet->id
        ]);

        Category::create([
            'name' => 'Máy tính bảng Huawei',
            'slug' => str_slug('Máy tính bảng Huawei'),
            'order' => 6,
            'parent' => $tablet->id
        ]);

        Category::create([
            'name' => 'Máy tính bảng Acer',
            'slug' => str_slug('Máy tính bảng Acer'),
            'order' => 7,
            'parent' => $tablet->id
        ]);

        Category::create([
            'name' => 'Máy tính bảng Dell',
            'slug' => str_slug('Máy tính bảng Dell'),
            'order' => 8,
            'parent' => $tablet->id
        ]);

        Category::create([
            'name' => 'Máy tính bảng Kingcom',
            'slug' => str_slug('Máy tính bảng Kingcom'),
            'order' => 9,
            'parent' => $tablet->id
        ]);

//        Laptop & Phụ kiện - 112
        $laptop_accessories = Category::create([
            'name' => 'Laptop & Phụ kiện',
            'slug' => str_slug('Laptop & Phụ kiện'),
            'order' => 4,
            'parent' => 0
        ]);
//        Laptop - 113
        $laptop = Category::create([
            'name' => 'Laptop',
            'slug' => str_slug('Laptop'),
            'order' => 0,
            'parent' => $laptop_accessories->id
        ]);

        Category::create([
            'name' => 'Laptop Apple',
            'slug' => str_slug('Laptop Apple'),
            'order' => 0,
            'parent' => $laptop->id
        ]);

        Category::create([
            'name' => 'Laptop Sony',
            'slug' => str_slug('Laptop Sony'),
            'order' => 1,
            'parent' => $laptop->id
        ]);

        Category::create([
            'name' => 'Laptop Asus',
            'slug' => str_slug('Laptop Asus'),
            'order' => 2,
            'parent' => $laptop->id
        ]);

        Category::create([
            'name' => 'Laptop Acer',
            'slug' => str_slug('Laptop Acer'),
            'order' => 3,
            'parent' => $laptop->id
        ]);

        Category::create([
            'name' => 'Laptop Dell',
            'slug' => str_slug('Laptop Dell'),
            'order' => 4,
            'parent' => $laptop->id
        ]);

        Category::create([
            'name' => 'Laptop HP',
            'slug' => str_slug('Laptop HP'),
            'order' => 5,
            'parent' => $laptop->id
        ]);

        Category::create([
            'name' => 'Laptop Lenovo',
            'slug' => str_slug('Laptop Lenovo'),
            'order' => 6,
            'parent' => $laptop->id
        ]);

//        Laptop Gaming - 121
        $laptop_gaming = Category::create([
            'name' => 'Laptop Gaming',
            'slug' => str_slug('Laptop Gaming'),
            'order' => 1,
            'parent' => $laptop_accessories->id
        ]);

        Category::create([
            'name' => 'Laptop Gaming MSI',
            'slug' => str_slug('Laptop Gaming MSI'),
            'order' => 0,
            'parent' => $laptop_gaming->id
        ]);

        Category::create([
            'name' => 'Laptop Gaming Dell',
            'slug' => str_slug('Laptop Gaming Dell'),
            'order' => 1,
            'parent' => $laptop_gaming->id
        ]);

        Category::create([
            'name' => 'Laptop Gaming Asus',
            'slug' => str_slug('Laptop Gaming Asus'),
            'order' => 2,
            'parent' => $laptop_gaming->id
        ]);

        Category::create([
            'name' => 'Laptop Gaming Acer',
            'slug' => str_slug('Laptop Gaming Acer'),
            'order' => 3,
            'parent' => $laptop_gaming->id
        ]);

        Category::create([
            'name' => 'Laptop Gaming HP',
            'slug' => str_slug('Laptop Gaming HP'),
            'order' => 4,
            'parent' => $laptop_gaming->id
        ]);

        Category::create([
            'name' => 'Laptop Gaming Lenovo',
            'slug' => str_slug('Laptop Gaming Lenovo'),
            'order' => 5,
            'parent' => $laptop_gaming->id
        ]);

        Category::create([
            'name' => 'Laptop Gaming Xiaomi',
            'slug' => str_slug('Laptop Gaming Xiaomi'),
            'order' => 6,
            'parent' => $laptop_gaming->id
        ]);

//        Laptop Workstation - 129
        $laptop_workstation = Category::create([
            'name' => 'Laptop Workstation',
            'slug' => str_slug('Laptop Workstation'),
            'order' => 2,
            'parent' => $laptop_accessories->id
        ]);

        Category::create([
            'name' => 'Laptop MSI',
            'slug' => str_slug('Laptop Workstation MSI'),
            'order' => 0,
            'parent' => $laptop_workstation->id
        ]);

//        Linh, phụ kiện laptop - 131
        $accessories_laptop = Category::create([
            'name' => 'Linh, phụ kiện laptop',
            'slug' => str_slug('Linh, phụ kiện laptop'),
            'order' => 3,
            'parent' => $laptop_accessories->id
        ]);

        Category::create([
            'name' => 'Ram laptop',
            'slug' => str_slug('Ram laptop'),
            'order' => 0,
            'parent' => $accessories_laptop->id
        ]);

        Category::create([
            'name' => 'Ổ cứng laptop',
            'slug' => str_slug('Ổ cứng laptop'),
            'order' => 1,
            'parent' => $accessories_laptop->id
        ]);

        Category::create([
            'name' => 'Pin laptop',
            'slug' => str_slug('Pin laptop'),
            'order' => 2,
            'parent' => $accessories_laptop->id
        ]);

        Category::create([
            'name' => 'Sạc laptop',
            'slug' => str_slug('Sạc laptop'),
            'order' => 3,
            'parent' => $accessories_laptop->id
        ]);

        Category::create([
            'name' => 'Túi,Balo laptop',
            'slug' => str_slug('Túi,Balo laptop'),
            'order' => 4,
            'parent' => $accessories_laptop->id
        ]);

        Category::create([
            'name' => 'Đế làm mát laptop',
            'slug' => str_slug('Đế làm mát laptop'),
            'order' => 5,
            'parent' => $accessories_laptop->id
        ]);

        Category::create([
            'name' => 'Bàn laptop',
            'slug' => str_slug('Bàn laptop'),
            'order' => 6,
            'parent' => $accessories_laptop->id
        ]);

        Category::create([
            'name' => 'Phụ kiện laptop khác',
            'slug' => str_slug('Phụ kiện laptop khác'),
            'order' => 7,
            'parent' => $accessories_laptop->id
        ]);

//        PC Đồng bộ & PC Gaming - 131
        $pc = Category::create([
            'name' => 'PC Đồng bộ & PC Gaming',
            'slug' => str_slug('PC Đồng bộ & PC Gaming'),
            'order' => 5,
            'parent' => 0
        ]);

        $pc_packet = Category::create([
            'name' => 'Máy đồng bộ',
            'slug' => str_slug('Máy đồng bộ'),
            'order' => 0,
            'parent' => $pc->id
        ]);

        $pc_gaming = Category::create([
            'name' => 'Máy tính chơi game',
            'slug' => str_slug('Máy tính chơi game'),
            'order' => 1,
            'parent' => $pc->id
        ]);

        $pc_multi = Category::create([
            'name' => 'Máy tính mini đa dụng',
            'slug' => str_slug('Máy tính mini đa dụng'),
            'order' => 2,
            'parent' => $pc->id
        ]);

        $pc_allinone = Category::create([
            'name' => 'Máy tính All in one',
            'slug' => str_slug('Máy tính mini All in one'),
            'order' => 3,
            'parent' => $pc->id
        ]);

        $pc_accessories = Category::create([
            'name' => 'Combo linh kiện gaming',
            'slug' => str_slug('Combo linh kiện gaming'),
            'order' => 1,
            'parent' => $pc->id
        ]);























//        Phụ kiện - 16
        $accessories = Category::create([
            'name' => 'Phụ kiện',
            'slug' => str_slug('Phụ kiện'),
            'order' => 6,
            'parent' => 0
        ]);

        Category::create([
            'name' => 'Phụ kiện Apple',
            'slug' => str_slug('Phụ kiện Apple'),
            'order' => 0,
            'parent' => $accessories->id
        ]);

        Category::create([
            'name' => 'Phụ kiện Samsung',
            'slug' => str_slug('Phụ kiện Samsung'),
            'order' => 1,
            'parent' => $accessories->id
        ]);

        Category::create([
            'name' => 'Phụ kiện HTC',
            'slug' => str_slug('Phụ kiện HTC'),
            'order' => 2,
            'parent' => $accessories->id
        ]);

        Category::create([
            'name' => 'Phụ kiện LG',
            'slug' => str_slug('Phụ kiện LG'),
            'order' => 3,
            'parent' => $accessories->id
        ]);

        Category::create([
            'name' => 'Phụ kiện Sony',
            'slug' => str_slug('Phụ kiện Sony'),
            'order' => 4,
            'parent' => $accessories->id
        ]);

        $categories = Category::all();
        foreach ($categories as $category){
            $category->description = 'Description:'.$category->name;
            $category->seo_title = 'SEO Title:'.$category->name;
            $category->keyword = 'Keyword:'.$category->name;
            $category->meta_description = 'Meta Description:'.$category->name;
            $category->save();
        }
    }
}
