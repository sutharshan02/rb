<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Services;

use App\Models\PersonalInfo;
use App\Models\Education;
use App\Models\Skill;
use App\Models\WorkHistory;
use Validator;
use Carbon\Carbon;

class ResumeBuildService
{
    /**
    * @author RR
    * @param form data
    * @return update data
    * @category Service
    * @access public
    * @since 26-07-2016
    */
    public function editSkill ($data)
    {
        $skill = Skill::where('resume_id','=',$data['resume_id'])->first();
        $skill->skills     = $data['skills'];
        $skill->save();
        return $skill;
    }

    /**
    * @author BM
    * @param form data
    * @return update data
    * @category Service
    * @access public
    * @since 26-07-2016
    */
     public function editPersonalInfo ($data)
    {
        $resume = PersonalInfo::where('resume_id' , '=', $data['resume_id'])->first();
        $resume->fill($data);
        $resume->save();
        
        return $resume; 
    }


    /**
    * @author BM
    * @param form data
    * @return update data
    * @category Service
    * @access public
    * @since 26-07-2016
    */
     public function editProfile ($data)
    {
        $resume = PersonalInfo::where('resume_id' , '=', $data['resume_id'])->first();
        if($resume)
        {
            $resume->fill($data);
            $resume->save();
        }
        
        
        return $resume; 
    }

    /**
    * @author BM
    * @param form data
    * @return update data
    * @category Service
    * @access public
    * @since 26-07-2016
    */
     public function editWork ($data)
    {
        // var_dump($data);exit;
        
        
        $resume = WorkHistory::where('work_id' , '=', $data['work_id'])->first();

        if($resume)
        {
            $resume->fill($data);
            $resume->save();
        }
        
        
        return $resume; 
    }


    /**
    * @author BM
    * @param form data
    * @return update data
    * @category Service
    * @access public
    * @since 26-07-2016
    */
     public function editEducation ($data)
    {
        // var_dump($data);exit;
        $resume = Education::where('education_id' , '=', $data['education_id'])->first();
        if($resume)
        {
            $resume->fill($data);
            $resume->save();
        }
        
        
        return $resume; 
    }


 
}