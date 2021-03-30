<?php
  namespace App\Traits;
  
use App\User;
use App\Model\Bonus;
use App\Http\Controllers\Controller;


    trait BonusManager{
        //unique_id,type,amount,user_id,referred_id,downline_number,investment_id,status,amount_paid,percentage

        function saveBonus($amount, $uplineReferralId, $enrollmentUniqueId, $loggedDetails, $userReferralIdColumnName, $referrerIdColumnName, $agentsColumnStatus, $bonusArray, $counter = 0, $type = 'bonus'){

            $bonusArray = [
                'normal'=>[5, 3, 2.6, 2.4, 2.2, 2, 1.8, 1.6, 1.4, 1.2, 1, 0.9, 0.8, 0.7, 0.6, 0.5, 0.4, 0.3, 0.2, 0.1],
                'silver'=>[5, 3, 2.6, 2.4, 2.2, 2, 1.8, 1.6, 1.4, 1.2, 1, 0.9, 0.8, 0.7, 0.6, 0.5, 0.4, 0.3, 0.2, 0.1],
                'diamond'=>[5, 3, 2.6, 2.4, 2.2, 2, 1.8, 1.6, 1.4, 1.2, 1, 0.9, 0.8, 0.7, 0.6, 0.5, 0.4, 0.3, 0.2, 0.1],
                'golden'=>[5, 3, 2.6, 2.4, 2.2, 2, 1.8, 1.6, 1.4, 1.2, 1, 0.9, 0.8, 0.7, 0.6, 0.5, 0.4, 0.3, 0.2, 0.1],
                'special'=>[5, 3, 2.6, 2.4, 2.2, 2, 1.8, 1.6, 1.4, 1.2, 1, 0.9, 0.8, 0.7, 0.6, 0.5, 0.4, 0.3, 0.2, 0.1],
            ];//normal, silver, diamond, golden, special

        if($uplineReferralId !== null && $uplineReferralId !== ''){

                $userDetails = User::where($userReferralIdColumnName, $uplineReferralId)->first();
                $yearly_subscription_status = $userDetails->yearly_subscription_status;
                if($userDetails !== null && $counter < count($bonusArray['normal'])){

                    //check to make sure the users yearly subscription status is truex
                    if($yearly_subscription_status === 'yes'){
                        $controller = new Controller();

                        $agentType = $userDetails->$agentsColumnStatus;//ascertain the type of agent being dealt with
                        $selectedBonusArray = $bonusArray[$agentType];//pick the array of bonus to be adminsterred

                        if($userDetails->guider_status == 1){
                            $bonusAmount = $amount * ($selectedBonusArray[$counter] / 100);
                            $bonusModel = new Bonus();
                            $bonusModel->unique_id = $controller->createUniqueId('course_enrollments_tb', 'unique_id');
                            $bonusModel->type = $type;
                            $bonusModel->amount = $bonusAmount;
                            $bonusModel->user_id = $userDetails->unique_id;
                            $bonusModel->referred_id = $loggedDetails->unique_id;
                            $bonusModel->downline_number  = ($counter + 1). 'Downline';
                            $bonusModel->investment_id = $enrollmentUniqueId;
                            $bonusModel->status = 'done';
                            $bonusModel->amount_paid = $amount;
                            $bonusModel->percentage = $selectedBonusArray[$counter];
                            $bonusModel->save();
                        }
                        //add the money to the user account
                        $userDetails->balance = $bonusAmount;
                        $userDetails->save();
                        
                    }

                    //call the function again
                    $counter++;
                    $uplineReferralId = $userDetails->$referrerIdColumnName;
                    $this->saveBonus($amount, $uplineReferralId, $enrollmentUniqueId, $loggedDetails, $userReferralIdColumnName, $referrerIdColumnName, $bonusArray, $counter, $type);
                    
                }
                
            }

        }//Silver Agent, Diamond Agent, Golden Agent, Special Agent

        public function selectDownlines($referrerIdColumnName, $userReferralIdColumnName, $userArray = [], $downlinesArray = [], $counter = 0)
        {
            $downlineForAllUser = [];
            if(count($userArray) > 0){
                foreach($userArray as $k => $eachUser){//loop through the users

                    $downlineForOneUser = User::where($referrerIdColumnName, $eachUser->$userReferralIdColumnName)->get();
                    if(count($downlineForOneUser) > 0){
                        
                        foreach($downlineForOneUser as $l => $eachDownLineForAUser){
                            $downlineForAllUser[] = $eachDownLineForAUser;
                        }

                    }
                    
                }
                $downlinesArray[($counter + 1)] = $downlineForAllUser;
                $userArray = $downlineForAllUser;
                if(count($downlineForAllUser) == 0){
                    //session(['array_of_downlines' => $downlinesArray]);
                }
                $counter++;
                $this->selectGuiderDlines($userArray, $downlinesArray, $counter);
            }
            else{
                session(['array_of_downlines' => $downlinesArray]);
            }
            
        }


    }
?>