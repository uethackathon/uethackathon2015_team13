<?php

namespace App\Providers;
use Faker\Provider\Base;

class Faker extends Base
{
    protected $dic = [
        "Các thầy cô ở X không chỉ là có chuyên môn cao, lòng yêu nghề và sự nhiệt tình, tâm huyết để đào tạo được biết bao thế hệ sinh viên X giỏi giang, năng động mà còn có tài năng văn nghệ khó ở đâu có được.",
        "Hoạt động với chất lượng cao không chỉ là đặc trưng mà còn là sứ mệnh cao cả của Trường ĐHCN, được nêu trong quyết định của Chính phủ về việc thành lập trường. Chất lượng cao vừa là động lực thúc đẩy mọi mặt hoạt động, vừa là phương châm hành động và mục tiêu phấn đấu của từng cá nhân, từng đơn vị và của toàn thể Nhà trường.",
        "Em mình học tại trường này, cơ sở vật chất khá tốt, chất lượng giảng dạy khá đảm bảo vì thuộc ĐH Quốc Gia mà. Em mình nói đây được coi là một trong những trường trọng điểm của cả nưóc về đào tạo công nghệ thông tin, khoa học máy tinh. ngoài ra trường có liên kết với nhiều công ty để tư vấn tuyển sinh, rất hữu ích cho các sĩ tử phân vân có nên học ngành CNTT hay không",
        "Mình thấy môi trường giáo dục ở đại học X khá tốt nhưng cơ sở vật chất chưa hiện đại, học phí cao",
    
    ];

    public function feedback()
    {
        shuffle($this->dic);
        return $this->dic[0];
    }
}
