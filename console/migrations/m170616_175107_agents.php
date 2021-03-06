<?php

use common\models\User;
use yii\db\Migration;

class m170616_175107_agents extends Migration
{
//    public function safeUp()
//    {
//        // create user
//        $user = new User();
//        $user->username = 'mikem';
//        $user->breeder_id = 1;
//        $user->profile_id = 1;
//        $user->email = 'mikem@mnetwork.org';
//        $user->setPassword('yOshero00');
//        $user->generateAuthKey();
//        $user->admin = true;
//        if($user->save())
//            echo '    > create User '.$user->id.':'.$user->username.' ... done'.PHP_EOL;
//    }
//
//    public function safeDown()
//    {
//        echo "m170614_174107_users cannot be reverted.\n";
//
//        return false;
//    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $ts = time();

        $this->batchInsert('user',
            [/*"id",*/"username","auth_key","password_hash","password_reset_token","email","admin","has_member","has_agent","has_provider","status","created_at","updated_at","sync_at"],
            [
                [/*10,*/'steve.wendlandt','l2-QdDX9RVVr6rgtXwXD7d6z6YJ4-Si1','$2y$13$o9r4S/kFcjmqrW3dcWEUp.tuZw6EaX3dlj0MzF1knS0VhQfXJTUAe','8jOAllLpWdGvqWhIF6ybMGZk_UPuCT-r_1505837047','stevew@selectedbenefits.com',false,false,true,false,10,1505837047,1505837047,0],
                [/*11,*/'todd.madrid','VQ36H_zDP06jke9Xu5wFycqgpmRmOmTP','$2y$13$f4QOUh2YduqQkLw13f/ZAewuow72V87daViGHoom38/7Vn/7ttJOG',Yii::$app->security->generateRandomString() . '_' .$ts,'toddmcic@gmail.com',false,false,true,false,10,1505837047,1505954161,0],
                [/*12,*/'mark_harris','Kfrxqu3ZshSN9ATA9ZSeVDynmXnTrkJi','$2y$13$Q.5GbLTpjBQDoaED/DIMkueJYG2kMf7wdacK3K5WhxEdpf7gaYhXK',Yii::$app->security->generateRandomString() . '_' .$ts,'markdharris@cox.net',false,false,true,false,10,1505837047,1506534535,0],
                [/*13,*/'bob.jabour','fY4V6i0leGgGPj56ACJ5wm1-ntGUawTb','$2y$13$ufk8qUHThd5XxNSahixPwOnJ02CLpUsX9YRFL5yl6aKAEQTXs2biK','PizU4Wt6b8vmyfgQ6mTrXdMmoFW81ATb_1505837047','bob@texashealthnow.com',false,false,true,false,10,1505837047,1505837047,0],
                [/*14,*/'grace.tornik','FZrt6vZwBg6qAw-Prx6dTageIp4aAWy_','$2y$13$Sm5IV0AfPx.ZPaxX0qI8rOVb7kj9UR7y6BD4dsXL/CpoZ50KhEScG','zpSSpmUPfoTTZgpE5Ie6jeh0o3L73wIq_1505837047','gracetornik@yahoo.com',false,false,true,false,10,1505837047,1505837047,0],
                [/*15,*/'reed.hitch','fuClIBPp91lAQ8wvzqJXuD1aG4OLF_Pm','$2y$13$KYhefQ/HfF9a625uOfJzxOp69MVZaisF8pD8.jfavcv0CVZVK1pXG','cv2kc9VJeGwbxTByI9WGrDEhoHFo9q6v_1505837047','reedhitch@msn.com',false,false,true,false,10,1505837047,1505837047,0],
                [/*16,*/'chris.ford','3AMNaeif4ulpCIPvJyzjwLQh0TX4H4Lb','$2y$13$B1KC7RnBZQNtRAqVGXbVauHG/fa5AbtiQ4t7XymXjfajp2K736R/q',Yii::$app->security->generateRandomString() . '_' .$ts,'chris.ford1@cox.net',false,false,true,false,10,1505837047,1506094948,0],
                [/*17,*/'rick.hamilton','rz1cojZ5Nt6Pthi0AXWXZOzmF2OR31nS','$2y$13$HAMIn1av43C//6OtKZ1Kc.z/hEyN2FcWixF9u7yp8KOPSNB1QKQ/m','H7hTdEFyIZvRMRYhP_cUJ4lheb0kFg_n_1505837047','rick.health@yahoo.com',false,false,true,false,10,1505837047,1505837047,0],
                [/*18,*/'steve.herman','YlzG9hJ-zdWfnzuB0oS2buAawmYts--O','$2y$13$ypaiC1etiz67W2.AHy.RTecYGwrRlRBziCNhS9q6LBnyEKzc48e/C','mpx0Lx7L1vB6RqOfKhfRSahjjgvqOxV5_1505837047','steveherman68@sbcglobal.net',false,false,true,false,10,1505837047,1505837047,0],
                [/*19,*/'ao.insurance','CDZaY_fkmdOTKC8DhcRCTFDwBdScT_lX','$2y$13$JP5fdD3.nPLLdGgZdMD8Zu63xasbd8kDA3a1kGitowzn5a0PXYBWW','0piodFx9HDOu6A27QPy6-ZzC0C_DCoKX_1505837047','lisa.aoinsagency@gmail.com',false,false,true,false,10,1505837047,1505837047,0],
                [/*20,*/'phil.raskin','_Gt5vRZaFfHB0HYUrOod1LPa7HKIgAaD','$2y$13$f0FuiXTfmmiMmu16ZYdtaODpHBWCJlQ7lzEk2DiaMzB1a4esY5hJC','0m1Ec_s_JGEyCs_o8Matis4PrLx3_F21_1505837047','lisamcconville2013@gmail.com',false,false,true,false,10,1505837047,1505837047,0],
                [/*21,*/'charles_harrell','VNJ3jEW99dgR2m95MMyv79BieltWzo9b','$2y$13$16MEFfxfl9OHLgJGZRC4ieRyGAoneEsXBUxQ6gsnK/comqVjNqYHu','ytyerVETeByLPZCeYLU-gEm6nPzQR4et_1505837047','c.harrell@allaboardbenefits.net',false,false,true,false,10,1505837047,1505837047,0],
                [/*22,*/'greg_myers','-4TVkx1Tu4CablwYmpvW-IKa30ts4Mia','$2y$13$NpQzJBSLcK6Yu3SLSFsns.FcHRdJv43vPhlu24Nto/9K8kg5eaNNy','l7na-fpaqCpn36ehsugsxTuzbifgCMc0_1505837047','greg@health-quotes.com',false,false,true,false,10,1505837047,1505837047,0],
                [/*23,*/'ryan.howell','depeOGC_uLvfE0gSufP4cJw-0Fi02rQw','$2y$13$IqHEMdZNd5KpSXaa/9jfBOCMBU9SOcX8gnpeQFWWP7kXwF7EaJZ8C',Yii::$app->security->generateRandomString() . '_' .$ts,'protectiveplanning@hotmail.com',false,false,true,false,10,1505837047,1506097691,0],
                [/*24,*/'taryn.collins','KIEintlQqOyP3ZRge1K1wm2k5VE9n_gi','$2y$13$zdMQHtpiRwqai3jNVAaMUue8mROZzmasrS4SIxsHxnSI/uqRx1o8m','jOJQBPJ6VCYf39nLY8G2EJ9r4Rf729zS_1505837047','taryn@streamlinebg.com',false,false,true,false,10,1505837047,1505837047,0],
                [/*25,*/'james.rippel','kM3rndC1jvvwiBFelHUopelZDqzV9P7k','$2y$13$4uuzL1ln3FU/eeQrWDSvd.KRmrK2FA9kKp1t4n7LM2SXHYk4UNeri',Yii::$app->security->generateRandomString() . '_' .$ts,'jim@chsmkting.com',false,false,true,false,10,1505837047,1505847663,0],
                [/*26,*/'reginald.jackson','IA8rzvd7iFi9aUIpfdOs8EGHmwI9Y9oM','$2y$13$FiQQUIW/MENJnF5gIt6/4.cnatoh59By.JoeU35k1q0RGl5JYFtaK','weQ2focFjG0uYt-eP4EhxSh_WtqPMnSQ_1505837047','reggiej@rjinsures.com',false,false,true,false,10,1505837047,1505837047,0],
                [/*27,*/'daniel.moen','oFKNKDlw3tCxYhJIOyGuL5LfwlBTYq5A','$2y$13$BmsUsHfz4GjVj7uK.GYpX.8red.uApVBIpyUPL83vtGnn8EQpenI6',Yii::$app->security->generateRandomString() . '_' .$ts,'danielsinbox@yahoo.com',false,false,true,false,10,1505837047,1506012050,0],
                [/*28,*/'todd_madrid','pYsVA7BF2hGPhFwqpE3lm3qAXvw-M-N4','$2y$13$yo2PDBdnBLw3hhBjMHxFuuCcu7q1hI8kEMc05Fi4/KocOZoB.qwye','Jj4I8vJI3UyfklC6yKkFryRY9mkBIRhw_1505837047','tmadrid45@gmail.com',false,false,true,false,10,1505837047,1505837047,0],
                [/*29,*/'charity.bliss','d8Vuq1VafK1D5C83bO0feaHeSmagVz5n','$2y$13$uAUMR4oivgZ/zUi8q4UFku3mqErz9pTtu6dketAResm4a9EBta.m6','9IyhvsdrX3IkiVpYEDarhWyGvnrLGZY2_1505837047','charityblissinc@gmail.com',false,false,true,false,10,1505837047,1505837047,0],
                [/*30,*/'sean.collins','TyL3Jlaoe_oxx50SiVW8b5e-cgreYbcF','$2y$13$PYWuRNPn7Snkt2.mZFtqGu17tjWs9OL7PzIJqq6wzJdAX7WW8G8va','8b3QyKGjOcr9a8rAnDjVdr-MewaAIlnK_1505837047','collins4s@sbcglobal.net',false,false,true,false,10,1505837047,1505837047,0],
                [/*31,*/'scott_eckley','Sv4O4w9Mdk9iE9E8MkkBtgu3RZgZrXw-','$2y$13$l49Jfe1vPd82HWiHnFJQn.BCK8TUrTOA.KHTTbSbS.SCZLBBzBPQW','_f5oE0KZP3DYrYUbBBZb5nIJNzRJdHEh_1505837047','seckley@apollo-insurance.com',false,false,true,false,10,1505837047,1505837047,0],
                [/*32,*/'tom_albers','IQ26yW58pYV2MFE-oFKlT6RIEEhsuOkh','$2y$13$WNsYy9xGAOUvlRtwKsqyAO5IYLRxVk/tKfH7ZkSSw6zZDgVJhVGLq','M0yOhZ5QwMHAM7A3fWgdbY1HQ8nA9RCS_1505837047','tom.healthcaresolutions@gmail.com',false,false,true,false,10,1505837047,1505837047,0],
                [/*33,*/'tracey_white','_JfefEHvgAMPZRZdKwVR0s8RlXCT8mFJ','$2y$13$n7wTHs4ADd0PSE09cp9VEeNMVPvvV2/UbP7evduPTUUM20HW..pRu','hxiBBp_JlY8uBWEJCDe4Emk2hh9ibAoB_1505837047','tracey@health-quotes.com',false,false,true,false,10,1505837047,1505837047,0],
                [/*34,*/'rmig','iepiNb8CclPDDXNboAFKLMGKgQTJkQsu','$2y$13$20p8t8AQw.XgQR0oIx.Nwefzp3yYqaC7ej.nJYVs6YCjEKSuEVUfO',Yii::$app->security->generateRandomString() . '_' .$ts,'russ@russmillerinsurancegroup.com',false,true,true,false,10,1505837047,1505837852,0],
                [/*35,*/'vel.roe','e1oYxgrHvhIlfKNINnRWJWo2W1BzQPKW','$2y$13$JZND7gt1uMYDP4.PH6zUIOTjuB6VeqWKvLNa69ieJl9ITy3cOSJgG',Yii::$app->security->generateRandomString() . '_' .$ts,'arvella1952@yahoo.com',false,false,true,false,10,1505837047,1506713230,0],
                [/*36,*/'suzi.mcalpine','KZkRhbJXR_q-Z5xf2WgergqU4odUORar','$2y$13$FM6dqa7tf5SKfh6ec8TIVeLOTugqqQ9V8vJjxpHvhuOYhyJVjnSmC',Yii::$app->security->generateRandomString() . '_' .$ts,'baseballmoma@sbcglobal.net',false,false,true,false,10,1505837047,1505941580,0],
                [/*37,*/'mikem','StcjN9CsZgZ6Een-hjGjo9cC5GGl7zjW','$2y$13$aCwNfsOTYdVpNRrVJP4xtusF/t6xetquRTqnSgEnqMF.bUO/GKNoi','3-InVluINlRTe-1POLL8c0xwcQJJkqY3_1505837067','mikem@mnetwork.org',false,true,false,false,10,1503507795,1503507795,0],
                [/*38,*/'test','2Hk4eIKH95Rn_atDquM6nBjCTMEmVATh','$2y$13$aebr5eTQnNEiwbcpe/vKz.D.lb0NOSrvjv6eh5tmeeJTfo/SmMCBu',Yii::$app->security->generateRandomString() . '_' .$ts,'test@kristest.com',false,true,false,false,10,1503513663,1503513663,0],
                [/*39,*/'mrsgp101310','f6KVc5vP2biirtQGRWGg7MoiNYkcdDmM','$2y$13$FZ6oQgXKfoWazPLJYZL0Veyxw1fiz1juxDOvTD5DmBXJzMVWcWFRS',Yii::$app->security->generateRandomString() . '_' .$ts,'mrsgp101310@gmail.com',false,true,false,false,10,1503514089,1503514089,0],
                [/*40,*/'agility_ins','8eTPC2oRtKiNiJgUJ_kQTW1ZyPBE58L7','$2y$13$8ErlheKfim8A.Eug3tS9yuEiV.A048j2DJUMeBT7alaWWs0mZ9Yxi','Sc49QJk_27Atg6wMNpeHEszC1IzPAGQJ_1506526072','support@aisbenefits.com',false,false,true,false,10,1506526072,1506526072,0],
                [/*41,*/'all.american','4Yn11T_5etxAyft3kjbZGpl_VQ_bUPnW','$2y$13$QJ78ryxsDVH6f./95o5yauGagKZPcXqFo.0oHJqXqM.aA4120yQtq','9JiSZtaDNcB_t8RcsQk4ptSRvA4rV4bR_1506526072','mike@allamericanbrokers.com',false,false,true,false,10,1506526072,1506526072,0],
                [/*42,*/'all.aboard','jGZSmsKZfqIAezBmXYrVf0CorIJINca0','$2y$13$ImK6CC77w2KGdSn9cpXat.i0ZiaPWRIrIZwcAG7m7A.uqFEr0qLbS','viT9wtZW6ZjKMN2CTc02-kTdLzoNEEpS_1506526072','mike@allaboardbenefits.net',false,false,true,false,10,1506526072,1506526072,0],
                [/*43,*/'all.insurance','HNluXMzhxB3ptBuXWblc8EDQbbYJ6Hhl','$2y$13$5igVt5vukqel/5dRix7uEeAEyiVmWTo79AQ2YcPfqAvJUE0MsfywS','mAJUpamKzqF7V6tLdcGp1fOD_wSRq7l6_1506526072','mike2@allamericanbrokers.com',false,false,true,false,10,1506526072,1506526072,0],
                [/*44,*/'jason_smith','aGy-mHf8QrxY0UQbpCdFJKW4OPjqXFpA','$2y$13$B5qwxnvESmra0Qv9.rOOn.rV1wXg96wF.tDcvznDkvwJOqPRAtZJy','OMV_60SMNrMtk7YGsadf_dcooXxJYie5_1506526072','jasonsmith1021@gmail.com',false,false,true,false,10,1506526072,1506526072,0],
                [/*45,*/'alicia.tranum','YRjLus9o_aKD-HSPOmfYVKBbI_zfEJTi','$2y$13$4b37jbb3Zru9GO5qI8x7cOL.f2gwkjvyq8NKJ83gBEcJSB7JIDHMq','_eztDs--yyqxOXo01eC-eOnRl-VMN23x_1506526072','benefitsx@netzero.net',false,false,true,false,10,1506526072,1506526072,0],
                [/*46,*/'brenda.rose','P2l58_iuQ5M9nCGLpECwx4C5MaiuRrTA','$2y$13$OR2pVcvyTIeCh7UGbGVoJ.IwXJKTt/XG7JLDZfCHrTTAxsLwojdKG','Ccq4AHpbPtVzQqAepGIcc8SdgADa5_I1_1506526072','b.rose@allaboardbenefits.com',false,false,true,false,10,1506526072,1506526072,0],
                [/*47,*/'bobby.young','isacbsjbtlJhk4wMPxFvJeQgJ4YnvXiO','$2y$13$KdGsWx/4Xctxqgt0qvptI.lWFYrNzApEvB7.Vu1WQQhir/QVRFB5G','XDM7667Oa7QN2UHlP08y3BD8--BSMAc7_1506526072','bobby@allaboardbenefits.net',false,false,true,false,10,1506526072,1506526072,0],
                [/*48,*/'icg_hopkins','b8iVBY-_AM76if2zytULZdDC9EiW7Chd','$2y$13$rebdkn9sZ9LlyPs.3LFr.OodR5Ad9rqG2RfqpzOcADhW/5PUPjI8C','mAptztpfs66lO5DhkGQuJmlAYFPOnLOa_1506526072','jdhopkins@webicg.com',false,false,true,false,10,1506526072,1506526072,0],
                [/*49,*/'kevin.reese','7Apo4Ie13IeTQtXlOKLTpV__lNJjdOCO','$2y$13$9OWikDzoPdiQUaOmjYcUgezcaRc/RY4zbLtWyiIcxb.s0CZZiLHhy','JwbHO2BhvbwlVJd0SIvlAWRokxDNFI4j_1506526072','bachinsgroup@bachig.com',false,false,true,false,10,1506526072,1506526072,0],
                [/*50,*/'kevin_reese','FATYKVvKHoo8ZelWwNfvy3FmMgjPQiRQ','$2y$13$ZJy9hpeWUxQ6fvAto/j1uerPXImWXnT8rQxqRJzlV/6kcnHNOEsda','SDIMIHiBvv4tmzcg4l5i42vy3UL-JUOE_1506526072','kreese@bachig.com',false,false,true,false,10,1506526072,1506526072,0],
                [/*51,*/'suzi.mcalpine2','xKG-L9Wjnzq-2Ve2y81zsD5pRt6UEXU4','$2y$13$3ybm68YoMLwTq6oWh00HrO.6hpSH/LdgHzb2kUiAaQ1UMBzIf5YP.','SoqjtJatJ-emPAwFZG8oC1b8jtZMNxOj_1506526072','baseballmoma2@sbcglobal.net',false,false,true,false,10,1506526072,1506526072,0],
                [/*52,*/'george_mitchell','FaFF8Ab1JvhOLgWIglnqE9VXLi7vmVee','$2y$13$cFJegfRGtN3AJ3jD/5t4y.z3RVWLSAKJNPhpaKQ1KBLg3qBO3/bye','Lj78O55xhMiIzWkm3IPWd4Gsq8ivwAiD_1506526072','george@totalinsurance4u.com',false,false,true,false,10,1506526072,1506526072,0],
                [/*53,*/'alternet.benefits','z1FPfHXG39EdO5He2v0d6PF0EAEmIOMf','$2y$13$QvovU.cJOcul64urahDKTOP9gG8oannSHTSOj4JzAfJUe8/59wi.C','5JyB-sFxnjOZRQUAM5Df33aY5ndtHWxu_1506526072','mike@alternetbenefits.com',false,false,true,false,10,1506526072,1506526072,0],
                [/*54,*/'tom.rotole','nVBPPsw6mM4zOY-ZhKN2mczBhEf0b1HI','$2y$13$ykE7eZ35FhUV3dOCo/iDsu2yBJgI5OBQQB1zvgQO8n/myJysC8lp6','EmgOaGDPQXhgsEgf6Y2e7Cd859zkuHIC_1506526072','tvrassoc@outlook.com',false,false,true,false,10,1506526072,1506526072,0],
                [/*55,*/'wiley_long','xUAFPW8Lw4zGWz7WLaNv7FdbbrRxIT6q','$2y$13$vO9iivbpOIp.ozlzPalGxOc0DT3ipsmbSUMyVD2mWwyYy2yqjq/ie',Yii::$app->security->generateRandomString() . '_' .$ts,'info@hsaforamerica.com',false,false,true,false,10,1506526072,1506726977,0],
                [/*56,*/'ron.cunningham','tqX-IvBoQAnoGxDc9etOvW4iOeKDMnRh','$2y$13$QQmYZC3vkwAXyKZ1Uwp7SOg0knIluA5oVZ63VAdvq/7IBcEW6kCeC','qfmkuDP6FRtQuOfHYVTW5aMCaxEuLbHg_1506526072','cunninghamrons@yahoo.com',false,false,true,false,10,1506526072,1506526072,0],
                [/*57,*/'david.crockett','8yGWHp3lAnrN_oyxPfexYDZ1CvPkQ98W','$2y$13$gXl.e/2VP1IIKDeKumi57eRGulvnjwOiQLT7UgzPFa59k3.cMiQVe',Yii::$app->security->generateRandomString() . '_' .$ts,'dcrockett@aisbenefits.com',false,false,true,false,10,1506526072,1506567347,0],
                [/*58,*/'richard_mayer','eG1LyJkJ_3qfPmBdhQ4PatQ2pBqnRHlE','$2y$13$ILM3JOFJS66cTuqHnxhaQusZ5GLNNzqo41Fyv69QUh9rH8zBQYmha','77Sbc74JrvUILWv5xgGPsMNQGE3l3H4l_1506526072','richmayer@richardmayerinsurance.com',false,false,true,false,10,1506526072,1506526072,0],
                [/*59,*/'michael_martin','Lfsk2g8f9KHQvGoTt5pkbaYoWGmAjqxS','$2y$13$jvlAHqva5weK5EGARwKeLuaE7g.14WLZOousGO.ioOJ7NvelVfYR6','PPl6cbzupVgTce3SVYCzc3I2q6TPBIPa_1506526072','mike@mdmins.com',false,false,true,false,10,1506526072,1506526072,0],
                [/*60,*/'vern.juel','AsxwCk_NUJlBQQhnfpO35DATYVVn4zsq','$2y$13$9hYwZpOeLlcR13gX2i4bHe9fPgpKOx1cSu6PmDTWnVw6TBsg7/6.G','gyX9qmzJh92dMaU9y7Jpaa-0Wu7ggCcd_1506526072','vjuel@charter.net',false,false,true,false,10,1506526072,1506526072,0],
                [/*61,*/'robin.cruson','8ytptWbs5w4GBGWN6ptpVYgEsGQGadKR','$2y$13$uG/klxcAVNrOik41j/BwGepn.jqk6JyzoAlanm9fV5/KBMdJiCMFG','QRmC4WUhscQy_X6Mnl4EWykHGyi7F28R_1506526072','robin@crusoninsurance.com',false,false,true,false,10,1506526072,1506526072,0],
                [/*62,*/'harry.cain','1xU4JPtKwOAJK0hPfa_DwohGltf_h4Gp','$2y$13$dnYbY4VkJIuytiMDDCCoyOaZkvJrh.odAFteDm5.pjuoeQA0.AfS2','WgjQJ-3tx1X2N5Dlshgt4gjvxnoFIYmD_1506526072','hpcain@gmail.com',false,false,true,false,10,1506526072,1506526072,0],
                [/*63,*/'brett_martin','oqxMpPirXvEzVptOn49o9EUYSS9RBGaj','$2y$13$Deun11a1xi6gCZ16w1JOT.212Y3LQQrQdLfFbYTFmqjifGGE9lt5C','0u4b-ZPdhv5VejHGkHVZQpWoYeUFch--_1506526072','faststartinsurance@gmail.com',false,false,true,false,10,1506526072,1506526072,0],
                [/*64,*/'david_rubey','Gm_MMFS85vOMpkj3AgPGQ-W5HS1ijS5y','$2y$13$X/c9r6uQ6ycFZFrHLr4d0e0sTJdHtY6YrEjMsO51iRkwmxKf8.2Oe','j2BxM5KFMcesFxEYM-ZCaXzsqFM4h8RN_1506526072','David@DMRInsuranceServices.com  ',false,false,true,false,10,1506526072,1506526072,0],
                [/*65,*/'david_may','z0vYw5oxj0gaTsuvEvzuPqqwcuYOmqjL','$2y$13$lfLC4G3ENB87VxJqKsF2XuFmKba9pS3a9uQrb/bg9yB8cK6lJG7Oi','YnpLlesOa-Vzs88NJlcbGVaI1aZhsfEW_1506526072','david@esick.org',false,false,true,false,10,1506526072,1506526072,0],
                [/*66,*/'agility.dc','q33dqRjYh9lZv8wteOcaH1pPtlBgkE_0','$2y$13$Dzs3q/X2G9lK.VJmO0sQcOqQmAk/dViCPXemK7.XpCKu5Lb952eAa','Vs0R9VhCHu1MWDcnDXDSa-_ky5syrn7q_1506526072','dcrockett+1@aisbenefits.com',false,false,true,false,10,1506526072,1506526072,0],
                [/*67,*/'charles.frazier','lL1qjHpySf89GzPfN0sNbaAfjl-O5ANo','$2y$13$TvMtVca1QZqiLUgnXgQfBOy7E3KAlTFfH.DWVJeD9Au6Zonz0grLe','riTBKlQ4SQghjg2E0XBQHrrCNwfTDmPV_1506526072','charles@alliedinsadv.com',false,false,true,false,10,1506526072,1506526072,0],
                [/*68,*/'mike.browne','Wl6ON-4FKCmtxDLKofrxeten0NyiGIbI','$2y$13$k3.8/.O47SrH7d1OfAB2gOyIrDLzaZgxryMn4CcupqmBpAX8d5r.2','N7hHSdUHA3uFE1QbO4cSBcvFOpEQgWYP_1506526072','info@nacdbenefits.com',false,false,true,false,10,1506526072,1506526072,0],
                [/*69,*/'robb.rothrock2','PIYgzTDom4FM8qSw65sUF78IYFHB-TDm','$2y$13$PDlPNkMEIimtvkzlm8diI.br0d7hDVqdO9sVtQWspb3qpknmtXqlu','VT5VGJ2DrjmB5zLRIhhIsL7fQO17gs3N_1506526072','robb@saferetirements.com',false,false,true,false,10,1506526072,1506526072,0],
            ]
        );



        $this->batchInsert('agent',
            [/*"id",*/"user_id","parent_id","ext_id","has_img","f_name","m_name","l_name","address","address2","city","state_id","zip","email","phone","organization","title","status","created_at","updated_at","sync_at"],
            [
                [/*4,*/10,null,140954,false,'STEVEN',null,'WENDLANDT','3000 WESLAYAN, SUITE 318',null,'HOUSTON',43,'77027','stevew@selectedbenefits.com','7136211440',null,null,10,1505837047,1505837047,0],
                [/*5,*/11,null,140972,false,'TODD',null,'MADRID','8105 RANCHO DE LA OSA TR.',null,'MCKINNEY',43,'75070','toddmcic@gmail.com','9727627570',null,null,10,1505837047,1505837047,0],
                [/*6,*/12,null,140987,false,'MARK',null,'HARRIS','2715 16TH STREET',null,'GREAT BEND',16,'67530','mark@esick.org','6207869559',null,null,10,1505837047,1506534667,0],
                [/*7,*/13,null,141011,false,'ROBERT',null,'JABOUR II','5068 WEST PLANO PKWY, STE 300',null,'PLANO',43,'75093','bob@texashealthnow.com','9723814232',null,null,10,1505837047,1505837047,0],
                [/*8,*/14,null,141072,false,'GRACE',null,'TORNIK','6300 CARRIZO DR.',null,'GRANBURY',43,'76049','gracetornik@yahoo.com','8172191901',null,null,10,1505837047,1505837047,0],
                [/*9,*/15,null,141093,false,'REED',null,'HITCH','3223 S LOOP 289 #240C',null,'LUBBOCK',43,'79423','reedhitch@msn.com','8067501210',null,null,10,1505837047,1505837047,0],
                [/*10,*/16,null,141165,false,'CHRISTOPHER',null,'FORD','PO BOX 30282','PO Box 30282','MIDWEST CITY',36,'73140','chris.ford1@cox.net','4056021512','FORD INS. SERVICES',null,10,1505837047,1506095009,0],
                [/*11,*/17,null,141182,false,'RICHARD',null,'HAMILTON','2212 MULBERRY LANE',null,'NEWCASTLE',36,'73065','rick.health@yahoo.com','4053141763','HAMILTON GROUP',null,10,1505837047,1505837047,0],
                [/*12,*/18,null,141253,false,'STEVE',null,'HERMAN','6142 BRANDEIS LN',null,'DALLAS',43,'75214','steveherman68@sbcglobal.net','2143638771',null,null,10,1505837047,1505837047,0],
                [/*13,*/19,null,141295,false,'PHIL',null,'RASKIN','7066 LAKEVIEW HAVEN DR STE108',null,'HOUSTON',43,'77095','lisa.aoinsagency@gmail.com','2813450805','AO INSURANCE AGENCY INC',null,10,1505837047,1505837047,0],
                [/*14,*/20,null,141326,false,'PHIL',null,'RASKIN','7066 LAKEVIEW HAVEN DR, #108',null,'HOUSTON',43,'77095','lisamcconville2013@gmail.com','2813450805','ISURE,LLC',null,10,1505837047,1505837047,0],
                [/*15,*/21,null,141335,false,'CHARLES',null,'HARRELL','5920 E. UNIVERSITY BLVD #4116',null,'DALLAS',43,'75206','c.harrell@allaboardbenefits.net','8004622322','CHARLES HARRELL',null,10,1505837047,1505837047,0],
                [/*16,*/22,null,141420,false,'GREG',null,'MYERS','PO BOX 1270',null,'WIMBERLEY',43,'78676','tracey@health-quotes.com','8887503164','TEXAS MEDICAL PLANS LLC',null,10,1505837047,1505837047,0],
                [/*17,*/23,null,141483,false,'RYAN',null,'HOWELL','10 HOLMSBY LN',null,'TAYLORS',40,'29687','protectiveplanning@hotmail.com','8649791006',null,null,10,1505837047,1505837047,0],
                [/*18,*/24,null,141553,false,'TARYN',null,'COLLINS','5443 FOX RUN BLVD',null,'FREDERICK',6,'80504','taryn@streamlinebg.com','7206758350','STREAMLINE BENEFITS GROUP',null,10,1505837047,1505837047,0],
                [/*19,*/25,null,141612,false,'JAMES',null,'RIPPEL','8955 BEAR CREEK',null,'SYLVANIA',35,'43560','jim@chsmkting.com','4193182323','RIPPEL & ASSOCIATES',null,10,1505837047,1505837047,0],
                [/*20,*/26,null,141768,false,'REGINALD',null,'JACKSON','10202 ANGELL STREET',null,'DOWNEY',5,'90242','reggiej@rjinsures.com','8773601144','RJ INSURANCE SERVICES',null,10,1505837047,1505837047,0],
                [/*21,*/27,null,141820,false,'DANIEL',null,'MOEN','5400 CLARK AVE #107',null,'LAKEWOOD',5,'90712','danielsinbox@yahoo.com','5624728177',null,null,10,1505837047,1505837047,0],
                [/*22,*/28,null,141875,false,'TODD',null,'MADRID','8105 RANCHO DE LA OSA TRAIL',null,'MCKINNEY',43,'75070','tmadrid45@gmail.com','9727627570',null,null,10,1505837047,1505837047,0],
                [/*23,*/29,null,141896,false,'CHARITY',null,'BLISS','941 NE 19TH AVE',null,'FORT LAUDERDALE',9,'33304','charityblissinc@gmail.com','3214325805','CHARITY BLISS INC',null,10,1505837047,1505837047,0],
                [/*24,*/30,null,141908,false,'SEAN',null,'COLLINS','1130 CHARLESTON STREET',null,'COSTA MESA',5,'92626','collins4s@sbcglobal.net','9494224003',null,null,10,1505837047,1505837047,0],
                [/*25,*/31,null,141916,false,'SCOTT',null,'ECKLEY','200 NE MISSOURI RD #200',null,'LEES SUMMIT',23,'64086','seckley@apollo-insurance.com','9132790077','APOLLO INSURANCE GROUP, INC',null,10,1505837047,1505837047,0],
                [/*26,*/32,null,141924,false,'TOM',null,'ALBERS','3021 YELLOWSTONE DR',null,'LAWRENCE',16,'66047','tom.healthcaresolutions@gmail.com','7855504922',null,null,10,1505837047,1505837047,0],
                [/*27,*/33,null,194697,false,'Tracey',null,'White','PO Box 1270',null,'Wimberley',43,'78676','tracey@health-quotes.com','8887503164','Texas Medical Plans',null,10,1505837047,1505837047,0],
                [/*28,*/34,null,260975,false,'Russell',null,'Miller','16801 Addison Road',null,'Addison',43,'75001','russ@russmillerinsurancegroup.com','8174001084','Russ Miller Insurance Group',null,10,1505837047,1505837047,0],
                [/*29,*/35,null,141377,false,'VEL',null,'ROE','3118 SO. CO. RD. 1069',null,'MIDLAND',43,'79706','arvella1952@yahoo.com','4322386677',null,null,10,1505837047,1505837047,0],
                [/*30,*/36,null,141002,false,'SUZI',null,'MCALPINE','8033 KRISTINA LN.',null,'NORTH RICHLAND HILLS',43,'76182','baseballmoma@sbcglobal.net','8175018732',null,null,10,1505837047,1505837047,0],
                [/*31,*/40,null,140929,false,'STEVE',null,'MCLAUGHLIN','16775 ADDISON ROAD, SUITE 605',null,'ADDISON',43,'75001','support@aisbenefits.com','8665909771','AGILITY INSURANCE SERVICES',null,10,1506526072,1506526072,0],
                [/*32,*/41,null,140930,false,'MIKE',null,'CROWSTON','11070 DELFORD CIRCLE',null,'DALLAS',43,'75228','mike@allamericanbrokers.com','8004622322','ALL AMERICAN BROKERS',null,10,1506526072,1506526072,0],
                [/*33,*/42,null,140934,false,'MIKE',null,'CROWSTON','11070 DELFORD CIRCLE',null,'DALLAS',43,'75228','mike@allaboardbenefits.net','8004622322','ALL ABOARD BENEFITS',null,10,1506526072,1506526072,0],
                [/*34,*/43,null,140937,false,'MIKE',null,'CROWSTON','16801 ADDISON RD. SUITE 247',null,'ADDISON',43,'75001','mike@allamericanbrokers.com','8888719660','NACD BENEFITS',null,10,1506526072,1506526072,0],
                [/*35,*/44,null,140939,false,'JASON',null,'SMITH','PO BOX 850095',null,'YUKON',36,'73085','jasonsmith1021@gmail.com','4053230235','HEARTLAND INSURANCE SOLUTIONS',null,10,1506526072,1506526072,0],
                [/*36,*/45,null,140947,false,'ALICIA',null,'TRANUM','4130 FORT HENRY DRIVE',null,'KINGSPORT',42,'37663','benefitsx@netzero.net','4232390015','BEYOND BENEFITS',null,10,1506526072,1506526072,0],
                [/*37,*/46,null,140952,false,'BRENDA',null,'ROSE','6162 E MOCKINGBIRD LN',null,'DALLAS',43,'75214','b.rose@allaboardbenefits.com','8004622322','ALL ABOARD BENEFITS',null,10,1506526072,1506526072,0],
                [/*38,*/47,null,140955,false,'BOBBY',null,'YOUNG','6504 WICKLIFF TRL',null,'PLANO',43,'75023','bobby@allaboardbenefits.net','2148216677','ALL ABOARD BENEFITS',null,10,1506526072,1506526072,0],
                [/*39,*/48,null,140975,false,'DAVID',null,'HOPKINS JR','4361 BLOSSOM HILL RD',null,'MORTON',24,'39117','jdhopkins@webicg.com','8888280905','INSURANCE CONSULTANTS GROUP  LLC',null,10,1506526072,1506526072,0],
                [/*40,*/49,null,140989,false,'KEVIN',null,'REESE','202 W. LOUISIANA STREET #208',null,'MCKINNEY',43,'75069','bachinsgroup@bachig.com','2148564761','BACH INSURANCE GROUP',null,10,1506526072,1506526072,0],
                [/*41,*/50,null,141000,false,'KEVIN',null,'REESE','506 COLORADO ST.',null,'SHERMAN',43,'75090','kreese@bachig.com','2148564761','BACH INSURANCE GROUP',null,10,1506526072,1506526072,0],
                [/*42,*/51,null,141002,false,'SUZI',null,'MCALPINE','8033 KRISTINA LN.',null,'NORTH RICHLAND HILLS',43,'76182','baseballmoma@sbcglobal.net','8175018732',null,null,10,1506526072,1506526072,0],
                [/*43,*/52,null,141003,false,'GEORGE',null,'MITCHELL','3056 E. JEROME',null,'MESA',3,'85204','george@totalinsurance4u.com','4806649227','MITCHELL\'S FAMILY INSURANCE',null,10,1506526072,1506526072,0],
                [/*44,*/53,null,141060,false,'MICHAEL',null,'BROWNE','4450 ARAPAHOE AVENUE',null,'BOULDER',6,'80303','mike@alternetbenefits.com','3036799600','ALTERNET BENEFITS',null,10,1506526072,1506526072,0],
                [/*45,*/54,null,141084,false,'THOMAS ',null,'ROTOLE','1935 SW ANDREW RD.',null,'TOWANDA',16,'67144','tvrassoc@outlook.com','3165412770','ROTOLE & ASSOCIATES, INC. ',null,10,1506526072,1506526072,0],
                [/*46,*/55,null,141328,false,'WILEY',null,'LONG','1001-A E. HARMONY RD ','#519','FORT COLLINS',6,'80525','info@hsaforamerica.com','8667492039','WILEY LONG ENTERPRISES, INC.','President',10,1506526072,1506625296,0],
                [/*47,*/56,null,141340,false,'RON',null,'CUNNINGHAM','980998 S 3390 RD',null,'MEEKER',36,'74855','cunninghamrons@yahoo.com','4058315270',null,null,10,1506526072,1506526072,0],
                [/*48,*/57,null,141370,false,'DAVID',null,'CROCKETT','16775 ADDISON RD.',null,'ADDISON',43,'75001','dcrockett@aisbenefits.com','8665909771',null,null,10,1506526072,1506526072,0],
                [/*49,*/58,null,141382,false,'RICHARD',null,'MAYER','3704 WINDSTONE DR',null,'PLANO',43,'75023','richmayer@richardmayerinsurance.com','9726187270',null,null,10,1506526072,1506526072,0],
                [/*50,*/59,null,141391,false,'MICHAEL',null,'MARTIN','7001 W PARKER RD. #422',null,'PLANO',43,'75093','mike@mdmins.com','9407351515','MDM INSURANCE SOLUTIONS',null,10,1506526072,1506526072,0],
                [/*51,*/60,null,141549,false,'VERN',null,'JUEL','122 PALOMINO CT.',null,'DENTON',43,'76208','vjuel@charter.net','9402390598',null,null,10,1506526072,1506526072,0],
                [/*52,*/61,null,141559,false,'ROBIN',null,'CRUSON','8105 RASOR BLVD',null,'PLANO',43,'75024','robin@crusoninsurance.com','9728963851','ROBIN G CRUSON dba Cruson Insurance Agency',null,10,1506526072,1506526072,0],
                [/*53,*/62,null,141571,false,'HARRY',null,'CAIN III','3673 FORTINGALE ROAD',null,'ATLANTA',10,'30341','hpcain@gmail.com','4049139472','HPCAIN CONSULTING, LLC',null,10,1506526072,1506526072,0],
                [/*54,*/63,null,141610,false,'BRETT',null,'MARTIN','1033 B AVENUE, SUITE 101-125',null,'CORONADO',5,'92118','faststartinsurance@gmail.com','6194899368',null,null,10,1506526072,1506526072,0],
                [/*55,*/64,null,141756,false,'DAVID',null,'RUBEY','978 CASSION DR.',null,'LEWISVILLE',43,'75067','David@DMRInsuranceServices.com  ','9727575337',null,null,10,1506526072,1506526072,0],
                [/*56,*/65,null,141804,false,'DAVID',null,'MAY','1875 50TH AVE',null,'PAWNEE ROCK',16,'67567','david@esick.org','6208040736',null,null,10,1506526072,1506526072,0],
                [/*57,*/66,null,141807,false,'DAVID',null,'CROCKETT','16775 ADDISON ROAD',null,'ADDISON',43,'75001','dcrockett+1@aisbenefits.com','8008801276','AGILITY INSURANCE SERVICES',null,10,1506526072,1506526072,0],
                [/*58,*/67,null,141862,false,'CHARLES',null,'FRAZIER','3461 - F LAWRENCEVILLE-SUWANEE RD',null,'SUWANEE',10,'30024','charles@alliedinsadv.com','6785467890','ALLIED INSURANCE ADVISORS, LLC',null,10,1506526072,1506526072,0],
                [/*59,*/68,null,141872,false,'MIKE',null,'BROWNE','16801 ADDISON RD., SUITE 247',null,'ADDISON',43,'75001','info@nacdbenefits.com','8446400400','ALTERNET BENEFITS',null,10,1506526072,1506526072,0],
                [/*60,*/69,null,146069,false,'Robb ',null,'Rothrock','908 Audelia Rd # 200-257',null,'Richardson',43,'75081','robb@saferetirements.com','2144142857','American Health Benefits',null,10,1506526072,1506526072,0],
            ]
        );


        /* PULL FROM E123!
        $this->batchInsert('agent_state_map',
            ['agent_id', 'state_id', 'created_at', 'updated_at'],
            [
                [22,14,$ts,$ts],
                [22,22,$ts,$ts],
                [22,27,$ts,$ts],
                [22,40,$ts,$ts],
                [22,43,$ts,$ts],
                [22,9,$ts,$ts],
                [22,16,$ts,$ts],
                [22,21,$ts,$ts],
                [22,28,$ts,$ts],
                [4,43,$ts,$ts],
                [4,9,$ts,$ts],
                [10,1,$ts,$ts],
                [10,2,$ts,$ts],
                [10,10,$ts,$ts],
                [10,11,$ts,$ts],
                [10,36,$ts,$ts],
                [10,40,$ts,$ts],
                [10,42,$ts,$ts],
                [10,43,$ts,$ts],
                [10,16,$ts,$ts],
                [13,43,$ts,$ts],
                [25,1,$ts,$ts],
                [25,3,$ts,$ts],
                [25,5,$ts,$ts],
                [25,10,$ts,$ts],
                [25,11,$ts,$ts],
                [25,18,$ts,$ts],
                [25,23,$ts,$ts],
                [25,26,$ts,$ts],
                [25,27,$ts,$ts],
                [25,35,$ts,$ts],
                [25,36,$ts,$ts],
                [25,38,$ts,$ts],
                [25,40,$ts,$ts],
                [25,42,$ts,$ts],
                [25,43,$ts,$ts],
                [25,9,$ts,$ts],
                [25,13,$ts,$ts],
                [25,16,$ts,$ts],
                [6,3,$ts,$ts],
                [6,6,$ts,$ts],
                [6,22,$ts,$ts],
                [6,27,$ts,$ts],
                [6,27,$ts,$ts],
                [6,36,$ts,$ts],
                [6,43,$ts,$ts],
                [6,44,$ts,$ts],
                [6,16,$ts,$ts],
                [9,27,$ts,$ts],
                [9,36,$ts,$ts],
                [9,43,$ts,$ts],
                [14,43,$ts,$ts],
                [16,43,$ts,$ts],
                [20,5,$ts,$ts],
                [20,22,$ts,$ts],
                [20,26,$ts,$ts],
                [20,27,$ts,$ts],
                [20,35,$ts,$ts],
                [20,40,$ts,$ts],
                [20,43,$ts,$ts],
                [26,11,$ts,$ts],
                [26,23,$ts,$ts],
                [26,36,$ts,$ts],
                [26,42,$ts,$ts],
                [26,16,$ts,$ts],
                [5,14,$ts,$ts],
                [5,22,$ts,$ts],
                [5,27,$ts,$ts],
                [5,40,$ts,$ts],
                [5,43,$ts,$ts],
                [5,9,$ts,$ts],
                [5,16,$ts,$ts],
                [5,21,$ts,$ts],
                [5,28,$ts,$ts],
                [7,22,$ts,$ts],
                [7,43,$ts,$ts],
                [7,44,$ts,$ts],
                [8,43,$ts,$ts],
                [21,3,$ts,$ts],
                [21,5,$ts,$ts],
                [21,38,$ts,$ts],
                [21,43,$ts,$ts],
                [21,13,$ts,$ts],
                [11,36,$ts,$ts],
                [24,3,$ts,$ts],
                [24,5,$ts,$ts],
                [24,43,$ts,$ts],
                [19,22,$ts,$ts],
                [19,35,$ts,$ts],
                [19,38,$ts,$ts],
                [19,40,$ts,$ts],
                [19,9,$ts,$ts],
                [23,43,$ts,$ts],
                [23,9,$ts,$ts],
                [15,43,$ts,$ts],
                [15,44,$ts,$ts],
                [28,36,$ts,$ts],
                [28,43,$ts,$ts],
                [12,43,$ts,$ts],
                [18,5,$ts,$ts],
                [18,6,$ts,$ts],
                [18,23,$ts,$ts],
                [18,27,$ts,$ts],
                [18,38,$ts,$ts],
                [18,43,$ts,$ts],
                [18,16,$ts,$ts],
                [18,44,$ts,$ts],
                [17,40,$ts,$ts],
                [17,10,$ts,$ts],
                [17,26,$ts,$ts],
                [27,43,$ts,$ts],
                [29,43,$ts,$ts],
                [30,43,$ts,$ts],
                [30,36,$ts,$ts],
                [30,23,$ts,$ts],
                [30,16,$ts,$ts],
                [30,6,$ts,$ts],
                [30,27,$ts,$ts],
                [30,3,$ts,$ts],
                [30,24,$ts,$ts],
                [30,1,$ts,$ts],
                [30,18,$ts,$ts],
                [30,42,$ts,$ts],
                [30,17,$ts,$ts],
                [30,26,$ts,$ts],
                [30,23,$ts,$ts],
                [30,22,$ts,$ts],
                [30,2,$ts,$ts],
                [30,13,$ts,$ts],
                [30,14,$ts,$ts],
            ]
        ); */


        $this->batchInsert('provider_agent_map',
            ['agent_id', 'provider_id', 'created_at', 'updated_at'],
            [
                [4, 9, $ts, $ts], [4, 10, $ts, $ts], [4, 11, $ts, $ts],
                [5, 9, $ts, $ts], [5, 10, $ts, $ts], [5, 11, $ts, $ts],
                [6, 9, $ts, $ts], [6, 10, $ts, $ts], [6, 11, $ts, $ts],
                [7, 9, $ts, $ts], [7, 10, $ts, $ts], [7, 11, $ts, $ts],
                [8, 9, $ts, $ts], [8, 10, $ts, $ts], [8, 11, $ts, $ts],
                [9, 9, $ts, $ts], [9, 10, $ts, $ts], [9, 11, $ts, $ts],
                [10, 9, $ts, $ts], [10, 10, $ts, $ts], [10, 11, $ts, $ts],
                [11, 9, $ts, $ts], [11, 10, $ts, $ts], [11, 11, $ts, $ts],
                [12, 9, $ts, $ts], [12, 10, $ts, $ts], [12, 11, $ts, $ts],
                [13, 9, $ts, $ts], [13, 10, $ts, $ts], [13, 11, $ts, $ts],
                [14, 9, $ts, $ts], [14, 10, $ts, $ts], [14, 11, $ts, $ts],
                [15, 9, $ts, $ts], [15, 10, $ts, $ts], [15, 11, $ts, $ts],
                [16, 9, $ts, $ts], [16, 10, $ts, $ts], [16, 11, $ts, $ts],
                [17, 9, $ts, $ts], [17, 10, $ts, $ts], [17, 11, $ts, $ts],
                [18, 9, $ts, $ts], [18, 10, $ts, $ts], [18, 11, $ts, $ts],
                [19, 9, $ts, $ts], [19, 10, $ts, $ts], [19, 11, $ts, $ts],
                [20, 9, $ts, $ts], [20, 10, $ts, $ts], [20, 11, $ts, $ts],
                [21, 9, $ts, $ts], [21, 10, $ts, $ts], [21, 11, $ts, $ts],
                [22, 9, $ts, $ts], [22, 10, $ts, $ts], [22, 11, $ts, $ts],
                [23, 9, $ts, $ts], [23, 10, $ts, $ts], [23, 11, $ts, $ts],
                [24, 9, $ts, $ts], [24, 10, $ts, $ts], [24, 11, $ts, $ts],
                [25, 9, $ts, $ts], [25, 10, $ts, $ts], [25, 11, $ts, $ts],
                [26, 9, $ts, $ts], [26, 10, $ts, $ts], [26, 11, $ts, $ts],
                [27, 9, $ts, $ts], [27, 10, $ts, $ts], [27, 11, $ts, $ts],
                [28, 9, $ts, $ts], [28, 10, $ts, $ts], [28, 11, $ts, $ts],
                [29, 9, $ts, $ts], [29, 10, $ts, $ts], [29, 11, $ts, $ts],
                [30, 9, $ts, $ts], [30, 10, $ts, $ts], [30, 11, $ts, $ts],
                [31, 9, $ts, $ts], [31, 10, $ts, $ts], [31, 11, $ts, $ts],
                [32, 9, $ts, $ts], [32, 10, $ts, $ts], [32, 11, $ts, $ts],
                [33, 9, $ts, $ts], [33, 10, $ts, $ts], [33, 11, $ts, $ts],
                [34, 9, $ts, $ts], [34, 10, $ts, $ts], [34, 11, $ts, $ts],
                [35, 9, $ts, $ts], [35, 10, $ts, $ts], [35, 11, $ts, $ts],
                [36, 9, $ts, $ts], [36, 10, $ts, $ts], [36, 11, $ts, $ts],
                [37, 9, $ts, $ts], [37, 10, $ts, $ts], [37, 11, $ts, $ts],
                [38, 9, $ts, $ts], [38, 10, $ts, $ts], [38, 11, $ts, $ts],
                [39, 9, $ts, $ts], [39, 10, $ts, $ts], [39, 11, $ts, $ts],
                [40, 9, $ts, $ts], [40, 10, $ts, $ts], [40, 11, $ts, $ts],
                [41, 9, $ts, $ts], [41, 10, $ts, $ts], [41, 11, $ts, $ts],
                [42, 9, $ts, $ts], [42, 10, $ts, $ts], [42, 11, $ts, $ts],
                [43, 9, $ts, $ts], [43, 10, $ts, $ts], [43, 11, $ts, $ts],
                [44, 9, $ts, $ts], [44, 10, $ts, $ts], [44, 11, $ts, $ts],
                [45, 9, $ts, $ts], [45, 10, $ts, $ts], [45, 11, $ts, $ts],
                [46, 9, $ts, $ts], [46, 10, $ts, $ts], [46, 11, $ts, $ts],
                [47, 9, $ts, $ts], [47, 10, $ts, $ts], [47, 11, $ts, $ts],
                [48, 9, $ts, $ts], [48, 10, $ts, $ts], [48, 11, $ts, $ts],
                [49, 9, $ts, $ts], [49, 10, $ts, $ts], [49, 11, $ts, $ts],
                [50, 9, $ts, $ts], [50, 10, $ts, $ts], [50, 11, $ts, $ts],
                [51, 9, $ts, $ts], [51, 10, $ts, $ts], [51, 11, $ts, $ts],
                [52, 9, $ts, $ts], [52, 10, $ts, $ts], [52, 11, $ts, $ts],
                [53, 9, $ts, $ts], [53, 10, $ts, $ts], [53, 11, $ts, $ts],
                [54, 9, $ts, $ts], [54, 10, $ts, $ts], [54, 11, $ts, $ts],
                [55, 9, $ts, $ts], [55, 10, $ts, $ts], [55, 11, $ts, $ts],
                [56, 9, $ts, $ts], [56, 10, $ts, $ts], [56, 11, $ts, $ts],
                [57, 9, $ts, $ts], [57, 10, $ts, $ts], [57, 11, $ts, $ts],
                [58, 9, $ts, $ts], [58, 10, $ts, $ts], [58, 11, $ts, $ts],
                [59, 9, $ts, $ts], [59, 10, $ts, $ts], [59, 11, $ts, $ts],
                [60, 9, $ts, $ts], [60, 10, $ts, $ts], [60, 11, $ts, $ts],
            ]
        );


    }

    public function down()
    {
        echo "m170614_174107_users cannot be reverted.\n";

        return false;
    }

}
