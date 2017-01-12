<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Wechat;
use Log;
use App\Repositories\TeacherWechatUserRepositoryEloquent;
use App\Repositories\LessonRepositoryEloquent;
class TeacherController extends Controller
{

    protected $TeacherWechatUser;
    protected $Lesson;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(TeacherWechatUserRepositoryEloquent $teacherwechatuser,LessonRepositoryEloquent $lesson)
    {
        $this->TeacherWechatUser = $teacherwechatuser;
        $this->Lesson = $lesson;
    }


    /**
     * 教师详细
     */
    public function index()
    {

    }

    /**
     * 医生绑定
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function Bind(Request $request)
    {
        $session = $request->session();
        $oauth = Wechat::oauth();
        if (!$session->has(config('zzmed.session.wechat_user'))) {
            $session->set(config('zzmed.doc_session.doc_wechat_oauth_jump_url'), config('zzmed.site.baseurl') . config('zzmed.doc_bind_page'));
            return $oauth->redirect();
        }

        //微信授权完成，获取高级授权信息
        $wxOauthUser = $this->WechatOAuthCheck(false);

        //判断此微信openid是否有关联正式账户
        $userId = $this->UserLoginCheck(false);

        $wechatJs = self::WechatJs();
        return view('teacher.bind', ["wechat_js" => $wechatJs]);
    }


    /**
     * 绑定微信
     * @param Request $request
     */
    public function DoBind(Request $request)
    {
        //判断唯一性

        $result= $this->TeacherWechatUser->create(["teacher_id"=>1,"openid"=>1]);
        print_r($result);

    }

    /**
     * 教师课程列表
     * @param Request $request
     */
    public function Lesson(Request $request)
    {

       $lesson_list= $this->Lesson->findwhere(['company_id'=>,'teacher_id'=>''])->all();
    }

    /**
     * 课程详细
     * @param Request $request
     */
    public function LessonInfo(Request $request)
    {

    }

    /**
     * 点名
     * @param Request $request
     */
    public function checkLessonStudent(Request $request)
    {

    }

    /**
     * check点名
     * @param Request $request
     */
    public function DocheckLessonStudent(Request $request)
    {

    }

}
