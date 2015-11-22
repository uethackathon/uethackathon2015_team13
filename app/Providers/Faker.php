<?php

namespace App\Providers;
use Faker\Provider\Base;

class Faker extends Base
{
    protected $dic = [
        "Đây là môi trường học tập rất tốt cho sinh viên. Chương trình đào tạo phù hợp với yêu cầu nhà tuyển dụng. Khung cảnh thoáng đãng, sạch sẽ, rộng rãi. Nói chung tôi yêu nơi này.",
        "Thưa thầy, khu vực giảng đường rất bẩn, rác vứt lung tung. Tàn thuốc lá vương vãi khắp nơi, mùi thuốc lá rất khó chịu. Điều này em nghĩ nên khắc phục sớm.",
        "Hệ thống wifi trước đây còn khó cho việc đăng nhập. Một số thời điểm cao điểm còn bị nghẽn mạng. Thật tuyệt vời mọi việc đã được cải thiện sau khi nâng cấp hạ tầng. Xin cảm ơn nhà trường.",
        "Mình thấy môi trường giáo dục ở đại học X khá tốt nhưng cơ sở vật chất chưa hiện đại, học phí cao",
        "chán lắm",
        "năm sau tôi sẽ thi vào UET",
    ];

    public function feedback()
    {
        shuffle($this->dic);
        return $this->dic[0];
    }
}
