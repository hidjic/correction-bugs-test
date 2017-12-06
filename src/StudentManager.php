<?php

namespace Wizacha\DevTest;

class StudentManager
{
    /**
     * @param int $studentId
     * @return string
     */
    public function getStudentName($studentId)
    {
        $data = $this->returnData();
        return $data['students'][$studentId]['name'];
    }

    /**
     * Teste si un étudiant était présent à un examen.
     *
     * @param int $studentId
     * @param string $examDate
     * @return bool
     */
    public function studentAttendedExam($studentId, $examDate)
    {
        $data = $this->returnData();
        foreach ($data['exam'] as $exam) {
            if ($exam['student'] === $studentId && $exam['date'] == $examDate && !is_null($exam['grade'])) {
                return true;
            }
        }
        return false;
    }

    /**
     * retourne le fichier data.json
     * 
     * @return array
     */
    public function returnData(){
        $json = file_get_contents(__DIR__ . '/../data.json');
        return json_decode($json, true);
    }

    /**
     * Retourne la moyenne d'un étudiant sur tous les examens jusqu'à une date donnée.
     *
     * @param string $studentName Nom de l'étudiant.
     * @param string $untilDate Date.
     * @return int
     */
    public function getStudentAverageGrade($studentName, $untilDate)
    {
        $data = $this->returnData();
        // récupération de l'id étudiant
        $idStudent = null;
        foreach($data['students'] as $ind=>$student){
            if($student['name'] === $studentName){$idStudent = $ind;}
        }
        // récupération des notes en fonction de la date
        $limitDate = new \DateTime($untilDate);
        $dateExam = null;
        $arrayGrade = array();
        foreach($data['exam'] as $exam){
            if($exam['student'] == $idStudent){
                $dateExam = new \DateTime($exam['date']);
                if($dateExam < $limitDate && !is_null($exam['grade'])){
                    array_push($arrayGrade,$exam['grade']);
                }
            }
        }
        // calcul de la moyenne
        $result = 0;
        foreach($arrayGrade as $grade){
            $result += $grade;
        }
        if(count($arrayGrade) === 0){
            $div = 1;
        }else{
            $div = count($arrayGrade);
        }
        $result = $result / $div;

        return round($result);
    }
}
