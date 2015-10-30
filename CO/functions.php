<?php 
    include("../connection/config.php");

    function jsonify($response) {
        $json = json_encode($response);
        $tabcount = 0;
        $result = '';
        $inquote = false;
        $tab = "   ";
        $newline = "\n";

        for ($i = 0; $i < strlen($json); $i++) {
            $char = $json[$i];

            if ($char == '"' && $json[$i - 1] != '\\')
                $inquote = !$inquote;

            if ($inquote) {
                $result.=$char;
                continue;
            }
            switch ($char) {
                case '{':
                    if ($i)
                        $result.=$newline;
                    $result.=str_repeat($tab, $tabcount) . $char . $newline . str_repeat($tab, ++$tabcount);
                    break;
                case '}':
                    $result.=$newline . str_repeat($tab, --$tabcount) . $char;
                    break;
                case ',':
                    $result.=$char;
                    if ($json[$i + 1] != '{')
                        $result.=$newline . str_repeat($tab, $tabcount);
                    break;
                default:
                    $result.=$char;
            }
        }
        return $result;
    }

    function checkCategory($main){
        $query = ORM::forTable("sms_costcat")->where("DESCRIPTION", $main)->count();
        $valid = false;

        if($query >= 1){
            $valid = true;
        }

        return $valid;
    }

    function addCostCategory($main){
        $query = ORM::forTable("sms_costcat")->create();
            $query->DESCRIPTION = $main;
        $query->save();

        return $query->asArray();
    }

    function addCostItems($id, $main){
        $query = ORM::forTable("sms_subsubcat")->create();
            $query->PROJID = $id;
            $query->cat2Id = 0;
            $query->DESCRIPTION = $main;
        $query->save();
    }

    // function checkItems($projId,$subId){
    //     $query = ORM::forTable("sms_subsubcat")->where("PROJID", $projId)->where();
    // }
    function getMainNameById($id){
        $query = ORM::forTable("sms_costcat")->where("CATID", $id)->findOne();
        return $query->DESCRIPTION;
    }

    function addItems($projId,$subId,$s_digOfSpec,$s_Qty,$s_Unit,$s_Um,$s_M,$s_Ul,$s_L,$s_Amount1,$s_Amount2){
        $query = ORM::forTable("sms_subsubcat")->create();
    }

    function getCat1($id, $projId){
        $query = ORM::forTable("sms_subsubcat")->where("PROJID", $projId)->where("cat1Id", $id)->where("cat2Id", 0)->where("cat3Id", 0)->where("cat4Id", 0)->where("cat5Id", 0)->orderByDesc("SUBSUBCATID")->limit(1)->findOne();
        return $query;
    }

    function getCat4($id1, $id2, $id3, $id4, $projId){
        $query = ORM::forTable("sms_subsubcat")->where("PROJID", $projId)->where("cat1Id", $id1)->where("cat2Id", $id2)->where("cat3Id", $id3)->where("cat4Id", $id4)->where("cat5Id", 0)->findMany();
        return $query;
    }

    function getCat2Name($id1, $id2, $projId){
        $query = ORM::forTable("sms_subsubcat")->where("PROJID", $projId)->where("cat1Id", $id1)->where("cat2Id", $id2)->where("cat3Id", 0)->where("cat4Id", 0)->where("cat5Id", 0)->findOne();
        return $query->DESCRIPTION;
    }

    function getCat3Name($id1, $id2, $id3, $projId){
        $query = ORM::forTable("sms_subsubcat")->where("PROJID", $projId)->where("cat1Id", $id1)->where("cat2Id", $id2)->where("cat3Id", $id3)->where("cat4Id", 0)->where("cat5Id", 0)->findOne();
        return $query->name;
    }

    function getCat4Name($id1, $id2, $id3, $id4, $projId){
        $query = ORM::forTable("sms_subsubcat")->where("PROJID", $projId)->where("cat1Id", $id1)->where("cat2Id", $id2)->where("cat3Id", $id3)->where("cat4Id", $id4)->where("cat5Id", 0)->findOne();
        return $query->name;
    }

    function insertCat2($projId, $cat1, $cat2, $desc, $dateCreated, $dateModified, $admin){
        $query = ORM::forTable("sms_subsubcat")->create();
            $query->PROJID = $projId;
            $query->cat1Id = $cat1;
            $query->cat2Id = $cat2;
            $query->DESCRIPTION = $desc;
            $query->date_created = $dateCreated;
            $query->date_modified = $dateModified;
            $query->admin_id = $admin;
        $query->save();
    }

    function insertCat3($projId, $id1, $id2, $id3, $text, $dateCreated, $dateModified, $admin){
        $query = ORM::forTable("sms_subsubcat")->create();
            $query->PROJID = $projId;
            $query->cat1Id = $id1;
            $query->DESCRIPTION = $text;
            $query->cat2Id = $id2;
            $query->cat3Id = $id3;
            $query->date_created = $dateCreated;
            $query->date_modified = $dateModified;
            $query->admin_id = $admin;
        $query->save();
    }
    function insertCat4($projId, $id1, $id2, $id3, $id4, $text, $dateCreated, $dateModified, $admin){
        $query = ORM::forTable("sms_subsubcat")->create();
            $query->PROJID = $projId;
            $query->cat1Id = $id1;
            $query->DESCRIPTION = $text;
            $query->cat2Id = $id2;
            $query->cat3Id = $id3;
            $query->cat4Id = $id4;
            $query->date_created = $dateCreated;
            $query->date_modified = $dateModified;
            $query->admin_id = $admin;
        $query->save();
    }

    function insertCat5($projId, $id1, $id2, $id3, $id4, $id5, $text, $dateCreated, $dateModified, $admin){
        $query = ORM::forTable("sms_subsubcat")->create();
            $query->PROJID = $projId;
            $query->cat1Id = $id1;
            $query->DESCRIPTION = $text;
            $query->cat2Id = $id2;
            $query->cat3Id = $id3;
            $query->cat4Id = $id4;
            $query->cat5Id = $id5;
            $query->date_created = $dateCreated;
            $query->date_modified = $dateModified;
            $query->admin_id = $admin;
        $query->save();
    }
    function getLastIdCat1($id, $projId){
        $query = ORM::forTable("sms_subsubcat")->where("PROJID", $projId)->where("cat1Id", $id)->whereNotEqual("cat2Id", 0)->where("cat3Id", 0)->count();
        return $query;
    }

    function getCat2($id1, $id2, $projId){
        $query = ORM::forTable("sms_subsubcat")->where("PROJID", $projId)->where("cat1Id", $id1)->where("cat2Id", $id2)->where("cat3Id", 0)->where("cat4Id", 0)->findMany();
        return $query;
    }

    function getCat3($id1, $id2, $id3, $projId){
        $query = ORM::forTable("sms_subsubcat")->where("PROJID", $projId)->where("cat1Id", $id1)->where("cat2Id", $id2)->where("cat3Id", $id3)->where("cat4Id", 0)->where("cat5Id", 0)->findMany();
        return $query;
    }

    function getLastIdCat2($id1, $id2, $projId){
        $query = ORM::forTable("sms_subsubcat")->where("PROJID", $projId)->where("cat1Id", $id1)->where("cat2Id", $id2)->whereNotEqual("cat3Id", 0)->where("cat4Id", 0)->count();
        return $query;
    }

    function getLastIdCat3($id1, $id2, $id3, $projId){
        $query = ORM::forTable("sms_subsubcat")->where("PROJID", $projId)->where("cat1Id", $id1)->where("cat2Id", $id2)->where("cat3Id", $id3)->whereNotEqual("cat4Id", 0)->where("cat5Id", 0)->count();
        return $query;
    }

    function getLastIdCat4($id1, $id2, $id3, $id4, $projId){
        $query = ORM::forTable("sms_subsubcat")->where("PROJID", $projId)->where("cat1Id", $id1)->where("cat2Id", $id2)->where("cat3Id", $id3)->where("cat4Id", $id4)->whereNotEqual("cat5Id", 0)->count();
        return $query;
    }

    function checkCat3ForCat2($id1, $id2, $projId){
        $query = ORM::forTable("sms_subsubcat")->where("PROJID", $projId)->where("cat1Id", $id1)->where("cat2Id", $id2)->whereNotEqual("cat3Id", 0)->where("cat4Id", 0)->count();
        $valid = false;
        if($query >= 1){
            $valid = true;
        }

        return $valid;
    }

    function checkCat4ForCat3($id1, $id2, $id3, $projId){
        $query = ORM::forTable("sms_subsubcat")->where("PROJID", $projId)->where("cat1Id", $id1)->where("cat2Id", $id2)->where("cat3Id", $id3)->whereNotEqual("cat4Id", 0)->where("cat5Id", 0)->count();
        $valid = false;
        if($query >= 1){
            $valid = true;
        }

        return $valid;
    }

    function checkCat5ForCat4($id1, $id2, $id3, $id4, $projId){
        $query = ORM::forTable("sms_subsubcat")->where("PROJID", $projId)->where("cat1Id", $id1)->where("cat2Id", $id2)->where("cat3Id", $id3)->where("cat4Id", $id4)->whereNotEqual("cat5Id", 0)->count();
        $valid = false;
        if($query >= 1){
            $valid = true;
        }

        return $valid;
    }

    function updateSubCategories($id, $column, $newValue){
        $query = ORM::forTable("sms_subsubcat")->where("SUBSUBCATID", $id)->findOne();
            $query->set($column, $newValue);
        $query->save();
    }

    function checkFByProjId($id){
        $query = ORM::forTable("sms_projects")->where("PROJID", $id)->whereNotEqual("F", 0)->count();
        $valid = false;
        if($query >= 1){
            $valid = true;
        }

        return $valid;
    }

    function addFByProjId($projId, $data){
        ORM::configure('id_column', 'PROJID');
        $query = ORM::forTable("sms_projects")->where("PROJID", $projId)->findOne();
            $query->set("F", $data);
        $query->save();
    }

    function getLastModified(){
        $query = ORM::forTable("sms_subsubcat")->orderByDesc("date_modified")->limit(1)->findOne();
        return $query->date_modified;
    }

    function getLastCreated(){
        $query = ORM::forTable("sms_subsubcat")->orderByDesc("date_created")->limit(1)->findOne();
        return $query->date_modified;
    }
    
    function getLastAdmin(){
        $query = ORM::forTable("sms_admin")->tableAlias("t1")->innerJoin("sms_subsubcat", array("t1.EMPID", "=", "t2.admin_id"), "t2")->orderByDesc("t2.date_modified")->limit(1)->findOne();
        return $query;
    }

    function getProjDetailsbyId($id){
        $query = ORM::forTable("sms_clients")
            ->rawQuery("SELECT count(SURNAME) as count, SURNAME, FIRSTNAME, pr.desc AS desc1, PROPERTYADD AS site, lvl.DESCRIPTION AS desc2, p.F as ef FROM sms_clients as c INNER JOIN sms_projects as p ON c.CID = p.CID INNER JOIN  sms_prod as pr ON p.PRODID = pr.prodid INNER JOIN sms_levelno as lvl ON p.TYPEID = lvl.LVLID WHERE p.PROJID = :uid", array("uid" => $id))
            ->findOne();
        return $query;
    }

    function getSumPerCat($id){
        $query = ORM::forTable("sms_subsubcat")->where("PROJID", $id)->sum("PROFIT_AMOUNT");
            // ->rawQuery("SELECT SUM(PROFIT_AMOUNT) as tot FROM sms_subsubcat WHERE PROJID = :uid", array("uid" => $id))->findOne();
        return $query;
    }

    function getMainCat(){
        $query = ORM::forTable("sms_costcat")->select("CATID", "cat")->select("DESCRIPTION", "cdesc")->findMany();
        return $query;
    }

    function getMainCat2ById($id){
        $query = ORM::forTable("sms_subsubcat")->where("PROJID", $id)->whereNotEqual("cat2Id", "0")->where("cat3Id", "0")->orderByAsc("PROJID")->findMany();
        return $query;
    }
    function getMainCat3ById($id, $id2){
        $query = ORM::forTable("sms_subsubcat")->where("PROJID", $id)->where("cat2Id", $id2)->whereNotEqual("cat3Id", "0")->where("cat4Id", 0)->orderByAsc("PROJID")->findMany();
        return $query;
    }

    function getMainCat4ById($id, $id2, $id3){
        $query = ORM::forTable("sms_subsubcat")->where("PROJID", $id)->where("cat2Id", $id2)->where("cat3Id", $id3)->whereNotEqual("cat4Id", 0)->where("cat5Id", 0)->orderByAsc("PROJID")->findMany();
        return $query;
    }
    function getMainCat5ById($id, $id2, $id3, $id4){
        $query = ORM::forTable("sms_subsubcat")->where("PROJID", $id)->where("cat2Id", $id2)->where("cat3Id", $id3)->where("cat4Id", $id4)->whereNotEqual("cat5Id", 0)->orderByAsc("PROJID")->findMany();
        return $query;
    }
?>