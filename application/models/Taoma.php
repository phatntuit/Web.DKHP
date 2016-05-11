<?php
	/**
	* 
	*/
	class Taoma extends CI_Model
	{
		
		public function Matudong($tenid,$tenbang,$chuoi,$limit)
		{
			$ketqua="";
			$khong="0";
			$max=0;
			$max=$limit-strlen($chuoi);
			// $limit là số ký tự cả chữ và số trong chuỗi mà
			// $max là số ký tự số trong chuỗi mã vd : MH0001 $max=4,$limit=6
			$im="";
			$sel="select ".$tenid." from ".$tenbang. " where ".$tenid." like '".$chuoi."%' order by ".$tenid." desc limit 1";
			$result = $this->db->query($sel);
			foreach ($result->result() as $row)
			{
				$im=$row->$tenid;
			}
			if ($im=="")
			{
				$im=1;
				for ($i=0; $i <$limit ; $i++) { 
					# code...
					$ketqua.=$khong;
				}
				$ketqua.=$im;


			}
			else
			{
				$im=substr($im,-(strlen($im)-2));
				$im=intval($im);
				$im+=1;
				for ($i=0; $i <$limit ; $i++) { 
					# code...
					$ketqua.=$khong;
				}
				$ketqua.=$im;
			}
			$ketqua=substr($ketqua,-$max);//lấy $max kí tự từ dưới lên;
			$chuoi.=$ketqua;
			//echo "$chuoi";
			return $chuoi;
		}
	}
?>