//...................................AssignFacultyCounselor..................//
function AssignFacultyCounselor(employee_id) {
	$.ajax({
		url: base_url + "MasterAdmin/AssigncounsFaculty",
		data: { employee_id: employee_id },
		type: "POST",
		success: function (data) {
			console.log(data);
			var data = JSON.parse(data);
			$("#Assign_FacultyId").val(data.AssignShowViewFaculty.employee_id);
			$("#Assign_Facultyname").val(data.AssignShowViewFaculty.emp_firstname);
		},
	});
}
//......................................AssignFacultyCounselor end..............//

//..........................add-lead counselling-details.................................//
$("#Edulevel_Id").change(function () {
	var CouncellingEdulevel_Id = $("#Edulevel_Id").val();

	$.ajax({
		url: base_url + "MasterAdmin/CounsellingDetaillevelbyClass",
		type: "post",
		data: { CouncellingEdulevel_Id: CouncellingEdulevel_Id },
		datatype: "json",
		success: function (response) {
			console.log(response);
			var ccldata = JSON.parse(response);
			$("#counsdetailClassId").html(ccldata);
		},
	});
});
//................................add-lead counselling-detail............................//
var expanded = false;
function CounsellingdetailDepndClass() {
	var counsdetailClassId = document.getElementById("counsdetailClassId");
	if (!expanded) {
		counsdetailClassId.style.display = "block";
		expanded = true;
	} else {
		counsdetailClassId.style.display = "none";
		expanded = false;
	}
}
//.................................add-lead counselling detail................................//

//............................................view Counselor start............................//
function ViewCounslorData(employee_id) {
	$.ajax({
		url: base_url + "MasterAdmin/CounslorViewData",
		data: { employee_id: employee_id },
		type: "POST",
		success: function (data) {
			var data = JSON.parse(data);
			console.log(data);

			document.getElementById(
				"EmpImageShow"
			).src = `../${data.CounslorShowData.empimage}`;
			$("#Show_Empid").val(data.CounslorShowData.employee_id);
			$("#ShowEmpjoindate").html(data.CounslorShowData.emp_joiningdate);
			$("#ShowEmptitle").html(data.CounslorShowData.emp_title);
			$("#ShowEmpfirstname").html(data.CounslorShowData.emp_firstname);
			$("#ShowEmpmiddlename").html(data.CounslorShowData.emp_middlename);
			$("#ShowEmplastname").html(data.CounslorShowData.emp_lastname);
			$("#ShowEmpDateofBirth").html(data.CounslorShowData.emp_dob);
			$("#ShowEmpNationality").html(data.CounslorShowData.emp_nationality);
			$("#ShowEmpCasteName").html(data.empcastename);
			$("#ShowEmpMotherTongue").html(data.CounslorShowData.emp_mothertongue);
			$("#ShowEmpMaritalStatus").html(data.CounslorShowData.emp_maritalstatus);
			$("#ShowEmpAdhaarno").html(data.ShowEmpDetailValue.emp_adhaarcard);
			$("#ShowEmpAddress").html(data.ShowEmpDetailValue.emp_streetname);
			$("#ShowEmpGender").html(data.CounslorShowData.emp_gender);

			$("#ShowEmpAge").html(data.CounslorShowData.emp_age);

			$("#ShowEmpReligion").html(data.empreligionname);

			$("#ShowEmpPanno").html(data.ShowEmpDetailValue.emp_pancard);

			$("#ShowEmpSSSMno").html(data.ShowEmpDetailValue.emp_sssmid);

			$("#ShowEmpBloodgroup").html(data.CounslorShowData.emp_bloodgroup);

			$("#ShowEmpSpousename").html(data.ShowEmpDetailValue.emp_spousename);

			$("#ShowEmpSpousecontact").html(
				data.ShowEmpDetailValue.emp_spousecontact
			);

			$("#ShowEmpSpouseemail").html(data.ShowEmpDetailValue.emp_spouseemail);

			$("#ShowEmpSpouseemail").html(data.ShowEmpDetailValue.emp_spouseemail);

			$("#ShowEmpBoardname").html(
				data.ShowEmpAcdemicdetail.emp_secondaryboardname
			);
			$("#ShowEmpYear").html(
				data.ShowEmpAcdemicdetail.emp_secondarypassingyear
			);
			$("#ShowEmpMainsubject").html(
				data.ShowEmpAcdemicdetail.emp_secondarymainsubject
			);
			$("#ShowEmpObtMarks").html(
				data.ShowEmpAcdemicdetail.emp_secondaryobtainedmarks
			);

			$("#ShowEmpSeniorboard").html(
				data.ShowEmpAcdemicdetail.emp_seniorsecondaryunivercityname
			);
			$("#ShowEmpSeniorYear").html(
				data.ShowEmpAcdemicdetail.emp_seniorsecondarypassyear
			);
			$("#ShowEmpSeniorMainSubjrct").html(
				data.ShowEmpAcdemicdetail.emp_seniorsecondarymainsubjectname
			);
			$("#ShowEmpSeniorMarks").html(
				data.ShowEmpAcdemicdetail.emp_seniorsecondarymarksobtained
			);

			$("#ShowEmpGraduationboardname").html(
				data.ShowEmpAcdemicdetail.emp_graduationunivercityname
			);
			$("#ShowEmpGraduationyear").html(
				data.ShowEmpAcdemicdetail.emp_graduationpassingyear
			);
			$("#ShowEmpGraduationsubject").html(
				data.ShowEmpAcdemicdetail.emp_graduationmainsubject
			);
			$("#ShowEmpGraduationmarks").html(
				data.ShowEmpAcdemicdetail.emp_graduationmarksobtained
			);

			$("#ShowEmpPostGraduationunvercityname").html(
				data.ShowEmpAcdemicdetail.emp_postgraduationunivercity
			);
			$("#ShowEmpPostGraduationYear").html(
				data.ShowEmpAcdemicdetail.emp_postgraduationpassingyear
			);
			$("#ShowEmpPostGraduationsubject").html(
				data.ShowEmpAcdemicdetail.emp_postgraduationmainsubjectname
			);
			$("#ShowEmpPostGraduationmarks").html(
				data.ShowEmpAcdemicdetail.emp_postgraduationmarksobtained
			);

			$("#ShowEmpAccountHoldername").html(
				data.ShowEmpBankdetail.emp_accountholdername
			);
			$("#ShowEmpbranchname").html(data.ShowEmpBankdetail.emp_bankbranchname);
			$("#ShowEmpBankname").html(data.ShowEmpBankdetail.emp_bankname);
			$("#ShowEmpaccountnumber").html(data.ShowEmpBankdetail.emp_accountnumber);
			$("#ShowEmpifsccode").html(data.ShowEmpBankdetail.emp_bankifsccode);

			$("#ShowEmpLastexp").html(
				data.ShowempLastdetailValue.emp_totalexperience
			);
			$("#ShowEmplastinstitute").html(
				data.ShowempLastdetailValue.emp_lastinstitutionname
			);
			$("#ShowEmplastdesignation").html(
				data.ShowempLastdetailValue.emp_lastdesignation
			);
			$("#ShowEmpformyearlast").html(
				data.ShowempLastdetailValue.emp_fromlastexperienceyear
			);
			$("#ShowEmpformyearto").html(
				data.ShowempLastdetailValue.emp_tolastexperienceyear
			);
			$("#ShowEmplastsalary").html(
				data.ShowempLastdetailValue.emp_lastexperiencesalary
			);

			$("#ShowEmpcurrentservingtime").html(
				data.Showempcurrentdetail.emp_totalservingtime
			);
			$("#ShowEmpcurrentipnumber").html(data.Showempcurrentdetail.emp_ipnumber);
			$("#ShowEmpcurrentdepart").html(data.empcurrentdeprtname);
			$("#ShowEmpcurrentdesignation").html(data.empcurrentdesignationname);
			$("#ShowEmpcurrentsubject").html(data.empcurrentexpertsubject);
			$("#ShowEmpcurrentshift").html(data.Showempcurrentdetail.emp_shifttype);
			$("#ShowEmpcurrentname").html(
				data.Showempcurrentdetail.emp_currentemployementname
			);
			$("#ShowEmpcurrentrelation").html(
				data.Showempcurrentdetail.emp_currentemployementrelation
			);

			$("#ShowEmpHouserent").html(data.ShowempAllowances.emp_houserent);
			$("#ShowEmpMedicalallowance").html(
				data.ShowempAllowances.emp_medicalallowance
			);
			$("#ShowEmpcityalw").html(data.ShowempAllowances.emp_citycompensatory);
			$("#ShowEmpdearnessalw").html(
				data.ShowempAllowances.emp_dearnessallowance
			);
			$("#ShowEmpspecialalw").html(data.ShowempAllowances.emp_specialallowance);

			$("#ShowEmptimeofincr").html(
				data.Showempincrementchart.emp_timeofincrement
			);
			$("#ShowEmpbeforeincrsal").html(
				data.Showempincrementchart.emp_beforeincrement
			);
			$("#ShowEmpincrementpercentage").html(
				data.Showempincrementchart.emp_incrementpercentage
			);
			$("#ShowEmpafterincrsal").html(
				data.Showempincrementchart.emp_afterincrement
			);
		},
	});
}

//..............................................view counselor end............................//

//...................................AssignFacultyCounselor..................//
function AssignFacultyCounselor(employee_id) {
	$.ajax({
		url: base_url + "MasterAdmin/AssigncounsFaculty",
		data: { employee_id: employee_id },
		type: "POST",
		success: function (data) {
			console.log(data);
			var data = JSON.parse(data);
			$("#Assign_FacultyId").val(data.AssignShowViewFaculty.employee_id);
			$("#Assign_Facultyname").val(data.AssignShowViewFaculty.emp_firstname);
		},
	});
}
//......................................AssignFacultyCounselor end..............//

//...................................AssignCounselorAreaShowdetail..................//
function AssignCounselorAreaShowdetail(employee_id) {
	$.ajax({
		url: base_url + "MasterAdmin/ShowdatassigncounsFaculty",
		data: { employee_id: employee_id },
		type: "POST",
		success: function (data) {
			console.log(data);
			var data = JSON.parse(data);
			$("#ShowAssign_Empid").html(
				data.assignCounslorShowdata.assigncounselor_empid
			);
			$("#ShowdetailAssign_FacName").html(
				data.assignCounslorShowdata.assigncounselor_empname
			);
			$("#ShowdetailAssign_empLevel").html(
				data.assignCounslorShowdata.assigncounselor_level
			);
			$("#detailAssigncounselor_empallotArea").html(
				data.assignCounslorShowdata.assigncounselor_areaid
			);
			$("#CounselorCreatedateshow").html(
				data.assignCounslorShowdata.assign_counselorcreatedate
			);
		},
	});
}
//......................................AssignCounselorAreaShowdetail end..............//

//...................................UpdateassignCounselor..................//
function UpdateassignCounselor(employee_id) {
	$.ajax({
		url: base_url + "MasterAdmin/assigncounsellerupatedta",
		data: { employee_id: employee_id },
		type: "POST",
		success: function (data) {
			console.log(data);
			var data = JSON.parse(data);

			$("#Edit_assignCounsellerId").val(
				data.assignCounsellerupdatedata.assigncounselor_id
			);
			$("#Edit_assigncounsellerempid").val(
				data.assignCounsellerupdatedata.assigncounselor_empid
			);
			$("#Edit_assigncounsellorfacultyName").val(
				data.assignCounsellerupdatedata.assigncounselor_empname
			);
			$("#Edit_assignempLevel").val(
				data.assignCounsellerupdatedata.assigncounselor_level
			);
			var numbers = data.data_arraycoma.length;

			for (var v = 0; v < Number(numbers); v++) {
				$(`#Edit_empareaShow_${data.data_arraycoma[v]}`).attr(
					"checked",
					"checked"
				);
			}
			$("#Edit_assigncounsellorcreatedate").val(
				data.assignCounsellerupdatedata.assign_counselorcreatedate
			);
		},
	});
}

//..................edit area ..................................//

var checkList = document.getElementById("Editlist1");
checkList.getElementsByClassName("anchoredit")[0].onclick = function (evt) {
	if (checkList.classList.contains("visible"))
		checkList.classList.remove("visible");
	else checkList.classList.add("visible");
};

//......................................UpdateassignCounselor end..............//
//......................................UpdateassignCounselor end..............//

//...............................addnewemp image preview.................................//
$(document).ready(() => {
	$("#empphoto").change(function () {
		const file = this.files[0];
		if (file) {
			let reader = new FileReader();
			reader.onload = function (event) {
				$("#EmpimgPreview").attr("src", event.target.result);
			};
			reader.readAsDataURL(file);
		}
	});
});

//........................................addnewemp image preview end.........................//
function showDiv(assigncounselor_id) {
	$.ajax({
		url: base_url + "MasterAdmin/view_profile",
		data: {
			assigncounselor_id: assigncounselor_id,
		},
		type: "POST",
		success: function (data) {
			console.log(data);
			var data = JSON.parse(data);
			//  alert(data.viewshowprofile.assigncounselor_empid);
			$("#assigncounsId").val(data.viewshowprofile.assigncounselor_id);
			$("#assignempId").html(data.viewshowprofile.assigncounselor_empid);
			$("#assigncounsName").html(data.viewshowprofile.assigncounselor_empname);
			$("#assigncounsName1").html(data.viewshowprofile.assigncounselor_empname);
			$("#assigncounsName2").html(data.viewshowprofile.assigncounselor_empname);
			$("#assigncounsName3").html(data.viewshowprofile.assigncounselor_empname);
			$("#assigncounsLevel").html(data.viewshowprofile.assigncounselor_level);
			$("#assigncounsArea").html(data.viewshowprofile.assigncounselor_areaid);

			$("#assigncounsnewEmail").html(data.viewnewshowprofile.emp_emailid);
			$("#assigncounsnewNumber").html(data.viewnumshowprofile.emp_esicnumber);
			$("#assigncounsnewemerNumber").html(
				data.viewnumshowprofile.emp_emergencycontact
			);
			$("#assigncounsacademicyear").html(
				data.viewacademicshowprofile.emp_postgraduationpassingyear
			);
			$("#assigncounsacademicyearuniver").html(
				data.viewacademicshowprofile.emp_postgraduationunivercity
			);
			$("#assignpostgraduationmainsubjectname").html(
				data.viewacademicshowprofile.emp_postgraduationmainsubjectname
			);
			$("#assigncounsacademicyearmarks").html(
				data.viewacademicshowprofile.emp_postgraduationmarksobtained
			);

			$("#gracounsacademicyearpassingyear").html(
				data.viewacademicshowprofile.emp_graduationpassingyear
			);
			$("#gracounsacademicyearuniver").html(
				data.viewacademicshowprofile.emp_graduationunivercityname
			);
			$("#gracounsacademicyearcourse").html(
				data.viewacademicshowprofile.emp_graduationmainsubject
			);
			$("#gracounsacademicyearmarks").html(
				data.viewacademicshowprofile.emp_graduationmarksobtained
			);

			$("#seniorsacademicyearpassingyear").html(
				data.viewacademicshowprofile.emp_seniorsecondarypassyear
			);
			$("#seniorsacademicyearboard").html(
				data.viewacademicshowprofile.emp_seniorsecondaryunivercityname
			);
			$("#seniorsacademicyearsubject").html(
				data.viewacademicshowprofile.emp_seniorsecondarymainsubjectname
			);
			$("#seniorsacademicyearmarks").html(
				data.viewacademicshowprofile.emp_seniorsecondarymarksobtained
			);

			$("#secondarysacademicyearpassingyear").html(
				data.viewacademicshowprofile.emp_secondarypassingyear
			);
			$("#secondarysacademicyearboard").html(
				data.viewacademicshowprofile.emp_secondaryboardname
			);
			$("#secondarysacademicyearmarks").html(
				data.viewacademicshowprofile.emp_secondaryobtainedmarks
			);
			$("#secondarysacademicyearsubject").html(
				data.viewacademicshowprofile.emp_secondarymainsubject
			);

			$("#secondarysacademicname").html(
				data.viewacademicshowprofile.emp_achievementname
			);
			$("#secondarysacademictype").html(
				data.viewacademicshowprofile.emp_achievementtype
			);
			$("#secondarysacademiclevel").html(
				data.viewacademicshowprofile.emp_achievementlevel
			);
			$("#secondarysacademiccategory").html(
				data.viewacademicshowprofile.emp_achievementcategory
			);
			$("#secondarysacademicsubcategory").html(
				data.viewacademicshowprofile.emp_achievementsubcategory
			);
			$("#secondarysacademicauthority").html(
				data.viewacademicshowprofile.emp_authority
			);

			$("#personaldeatailsdob").html(data.viewparsonalshowprofile.emp_dob);
			$("#personaldeatailsgender").html(
				data.viewparsonalshowprofile.emp_gender
			);
			$("#personaldeatailsage").html(data.viewparsonalshowprofile.emp_age);
			$("#personaldeatailsreligion").html(
				data.viewparsonalshowprofile.emp_religion
			);
			$("#personaldeatailscaste").html(
				data.viewparsonalshowprofile.emp_castecategoryid
			);
			$("#personaldeatailsnationality").html(
				data.viewparsonalshowprofile.emp_nationality
			);
			$("#personaldeatailsmothert").html(
				data.viewparsonalshowprofile.emp_mothertongue
			);
			$("#personaldeatailsblood").html(
				data.viewparsonalshowprofile.emp_bloodgroup
			);
			// $('#personaldeatailsdob').html(data.viewparsonalshowprofile.emp_dob);

			$("#empdeatailsaadhar").html(data.viewempshowprofile.emp_adhaarcard);
			$("#empdeatailsssm").html(data.viewempshowprofile.emp_sssmid);
			$("#empdeatailpan").html(data.viewempshowprofile.emp_pancard);
			$("#empdeatailsemp").html(data.viewempshowprofile.emp_pfnumber);
			$("#empdeatailsesic").html(data.viewempshowprofile.emp_esicnumber);
			$("#empdeatailfathername").html(data.viewempshowprofile.emp_spousename);
			$("#empdeatailcontectno").html(data.viewempshowprofile.emp_spousecontact);
			// $('#empdeatailfatherdob').html(data.viewempshowprofile.);
			$("#empdeatailemrname").html(data.viewempshowprofile.emp_emergencyname);
			// $('#empdeatailemrname').html(data.viewempshowprofile.);
			$("#empdeatailemrcontect").html(
				data.viewempshowprofile.emp_emergencycontact
			);
			$("#empdeatailemrrelation").html(
				data.viewempshowprofile.emp_emergencyrelation
			);
			// $('#empdeatailemrname').html(data.viewempshowprofile.emp_emergencyname);

			// $('#empdeatailfatheradhar').html(data.viewempshowprofile.emp_spousename);

			$("#empdeatailempdocuments").html(
				data.viewempshowincrementprofile.attached_documents
			);

			$("#exprienceempinstitutename").html(
				data.viewempshowexprienceprofile.emp_lastinstitutionname
			);
			$("#exprienceempdesignation").html(
				data.viewempshowexprienceprofile.emp_lastdesignation
			);
			$("#exprienceempsalary").html(
				data.viewempshowexprienceprofile.emp_lastexperiencesalary
			);
			$("#exprienceempfromyear").html(
				data.viewempshowexprienceprofile.emp_fromlastexperienceyear
			);
			$("#exprienceemptoyear").html(
				data.viewempshowexprienceprofile.emp_tolastexperienceyear
			);
		},
	});
}

//........................................update Admitted Students.............................//
function UpdateAdmittedStudent(lead_id) {
	$.ajax({
		url: base_url + "MasterAdmin/AdmittedStudentupdateData",
		data: { lead_id: lead_id },
		type: "POST",
		success: function (data) {
			console.log(data);
			var data = JSON.parse(data);
			$("#Edit_admitstuleadid").val(data.admitstudentsdata.lead_id);
			$("#Edit_admitstuname").val(data.admitstudentsdata.lead_firstname);
			$("#Edit_admitsstulevelsname").val(
				data.admitstudentsdata.leadcouns_levelsid
			);
			$("#Edit_admitstuclassesname").val(data.admitstudentsdata.leadclasses);
			$("#Edit_admitstucounselorname").val(
				data.admitstudentsdata.lead_assigncounsellorname
			);
		},
	});
}
//........................................update Admitted Students end.......................//

//....................add_studets.........................//
function Addstudents(lead_id) {
	$.ajax({
		url: base_url + "MasterAdmin/leadStudentData",
		data: { lead_id: lead_id },
		type: "POST",
		success: function (data) {
			console.log(data);
			var data = JSON.parse(data);
			$("#leadStuId").val(data.studentsdata.lead_id);
			$("#LeadStudentName").val(data.studentsdata.lead_firstname);
			$("#leadstumiddlename").val(data.studentsdata.lead_middlename);
			$("#leadstulastname").val(data.studentsdata.lead_lastname);
			$("#leadstudentdob").val(data.studentsdata.lead_persondob);

			$("#leadstudentcaste").val(data.studentsdata.lead_personcasteId);

			$("#leadincomeid").val(data.studentsdata.lead_IncomerangeId);

			$("#studentfathername").val(data.studentsdata.lead_fathername);

			$("#studentmothername").val(data.studentsdata.lead_mothername);
		},
	});
}
//....................add_students.........................//

function addressFunction() {
	if (document.getElementById("same").checked) {
		document.getElementById("secondaryhouseno").value =
			document.getElementById("primaryhouseno").value;
		document.getElementById("secondarystreetno").value =
			document.getElementById("primarystreetno").value;
		document.getElementById("secondarycolonyname").value =
			document.getElementById("primarycolonyname").value;
		document.getElementById("secondarycity").value =
			document.getElementById("primarycity").value;
		document.getElementById("secondarystate").value =
			document.getElementById("primarystate").value;
		document.getElementById("secondarypincode").value =
			document.getElementById("primarypincode").value;
	} else {
		document.getElementById("secondaryhouseno").value = "";
		document.getElementById("secondarystreetno").value = "";
		document.getElementById("secondarycolonyname").value = "";
		document.getElementById("secondarycity").value = "";
		document.getElementById("secondarystate").value = "";
		document.getElementById("secondarypincode").value = "";
	}
}

// student allot section  -> student section
function stu_Allot_secton() {
	var alloatstusectiontblid = $(".alloatstusection").serialize();
	$.ajax({
		url: base_url + "MasterAdmin/Allot_student_sectiondata",
		data: alloatstusectiontblid,
		type: "POST",
		success: function (data) {
			var Data = JSON.parse(data);
			$("#student_id").val(Data.student_id);
		},
	});
}

// transfer employee department -> hr section
function employee_transfer_dep() {
	var transferempid = $(".transferemp").serialize();
	// alert(transferempid);
	$.ajax({
		url: base_url + "MasterAdmin/Transfer_employee_department",
		data: transferempid,
		type: "POST",
		success: function (data) {
			var Data = JSON.parse(data);
			$("#employee_id").val(Data.employee_id);
		},
	});
}

function Emp_idcard() {
	var empcardprintempid = $(".transferemp").serialize();
	$.ajax({
		url: base_url + "MasterAdmin/idcard_employee",
		data: empcardprintempid,
		type: "POST",
		success: function (data) {
			var Data = JSON.parse(data);
			$("#EmpcardDivtbldata").html(Data.EmpcardData);
		},
	});
}

//........................................edit emp starting...........................................

function Updateemp(employee_id) {
	$.ajax({
		url: base_url + "MasterAdmin/updateempdata",
		data: { employee_id: employee_id },
		type: "POST",
		success: function (data) {
			console.log(data);
			var data = JSON.parse(data);

			$("#Edit_empid").val(data.Empeditdata.employee_id);

			$("#Edit_empautogenrate").val(data.Empeditdata.empautonumber);

			$("#Edit_EmpJoindate").val(data.Empeditdata.emp_joiningdate);
			$("#Edit_Title").val(data.Empeditdata.emp_title);
			$("#Edit_empFirstname").val(data.Empeditdata.emp_firstname);
			$("#Edit_empMiddlename").val(data.Empeditdata.emp_middlename);
			$("#Edit_EmpLastname").val(data.Empeditdata.emp_lastname);
			$("#Edit_Empdob").val(data.Empeditdata.emp_dob);
			$("#Edit_Empage").val(data.Empeditdata.emp_age);
			$("#Edit_Nationality").val(data.Empeditdata.emp_nationality);
			$("#Edit_relignid").val(data.Editrelignid);
			$("#Edit_casteid").val(data.editcasteid);
			$("#Edit_empmothertongue").val(data.Empeditdata.emp_mothertongue);
			$("#Edit_empgender").val(data.Empeditdata.emp_gender);
			$("#Edit_maritalstatus").val(data.Empeditdata.emp_maritalstatus);
			$("#Edit_empcontact").val(data.Empeditdata.emp_contactno);
			$("#Edit_empemail").val(data.Empeditdata.emp_emailid);
			$("#Edit_empblood").val(data.Empeditdata.emp_bloodgroup);

			$("#Edit_emppancardnumber").val(data.Editempdetailvalue.emp_pancard);
			$("#Edit_empaadharnumber").val(data.Editempdetailvalue.emp_adhaarcard);
			$("#Edit_empssmnumber").val(data.Editempdetailvalue.emp_sssmid);
			$("#Edit_emppfnumber").val(data.Editempdetailvalue.emp_pfnumber);
			$("#Edit_emppesicnumber").val(data.Editempdetailvalue.emp_esicnumber);

			$("#Edit_empspousename").val(data.Editempdetailvalue.emp_spousename);
			$("#Edit_empspouseconatact").val(
				data.Editempdetailvalue.emp_spousecontact
			);
			$("#Edit_empspouseemail").val(data.Editempdetailvalue.emp_spouseemail);

			$("#Edit_empemergencyname").val(
				data.Editempdetailvalue.emp_emergencyname
			);
			$("#Edit_empemergencyrelation").val(
				data.Editempdetailvalue.emp_emergencyrelation
			);
			$("#Edit_empemergencycontact").val(
				data.Editempdetailvalue.emp_emergencycontact
			);

			$("#Edit_emphouseno").val(data.Editempdetailvalue.emp_houseno);
			$("#Edit_empstreetname").val(data.Editempdetailvalue.emp_streetname);
			$("#Edit_empcolonyname").val(data.Editempdetailvalue.emp_colonyname);
			$("#Edit_empcity").val(data.Editempdetailvalue.emp_city);
			$("#Edit_empstate").val(data.Editempdetailvalue.emp_state);
			$("#Edit_emppincode").val(data.Editempdetailvalue.emp_pincode);

			$("#Edit_Postgraduationyeremp").val(data.editpostgraduationyear);
			$("#Edit_Postboardemp").val(
				data.editempacdemivalues.emp_postgraduationunivercity
			);
			$("#Edit_postsubject").val(
				data.editempacdemivalues.emp_postgraduationmainsubjectname
			);
			$("#Edit_emppostmarks").val(
				data.editempacdemivalues.emp_postgraduationmarksobtained
			);

			$("#edit_passingyeargraduation").val(
				data.editempacdemivalues.emp_graduationpassingyear
			);
			$("#edit_graduationunivercity").val(
				data.editempacdemivalues.emp_graduationunivercityname
			);
			$("#edit_empsubject").val(
				data.editempacdemivalues.emp_graduationmainsubject
			);
			$("#edit_empgradumarks").val(
				data.editempacdemivalues.emp_graduationmarksobtained
			);

			$("#edit_emppassingyear10th").val(
				data.editempacdemivalues.emp_secondarypassingyear
			);
			$("#edit_emp10thboard").val(
				data.editempacdemivalues.emp_secondaryboardname
			);
			$("#edit_emp10thsubjectname").val(
				data.editempacdemivalues.emp_secondarymainsubject
			);
			$("#edit_emp10thmarks").val(
				data.editempacdemivalues.emp_secondaryobtainedmarks
			);

			$("#edit_emp12thpassingyear").val(
				data.editempacdemivalues.emp_seniorsecondarypassyear
			);
			$("#edit_emp12thboardname").val(
				data.editempacdemivalues.emp_seniorsecondaryunivercityname
			);
			$("#edit_emp12thsubjectname").val(
				data.editempacdemivalues.emp_seniorsecondarymainsubjectname
			);
			$("#edit_emp12thmarks").val(
				data.editempacdemivalues.emp_seniorsecondarymarksobtained
			);

			$("#edit_empachivementname").val(
				data.editempacdemivalues.emp_achievementname
			);
			$("#edit_empachivementtype").val(
				data.editempacdemivalues.emp_achievementtype
			);
			$("#edit_empachivemetlevel").val(
				data.editempacdemivalues.emp_achievementlevel
			);
			$("#edit_empachivemetcategory").val(
				data.editempacdemivalues.emp_achievementcategory
			);
			$("#edit_empachivemetsubcategory").val(
				data.editempacdemivalues.emp_achievementsubcategory
			);
			$("#edit_empauthority").val(data.editempacdemivalues.emp_authority);

			$("#edit_empaccholdername").val(
				data.editempbankvalues.emp_accountholdername
			);
			$("#edit_empbankname").val(data.editempbankvalues.emp_bankname);
			$("#edit_empbrachname").val(data.editempbankvalues.emp_bankbranchname);
			$("#edit_empbankcityname").val(data.editempbankvalues.emp_bankcityname);
			$("#edit_empaccountnumber").val(data.editempbankvalues.emp_accountnumber);
			$("#edit_empbankifsccode").val(data.editempbankvalues.emp_bankifsccode);

			$("#edit_emptotalexperience").val(
				data.Editlastemployeementvalues.emp_totalexperience
			);
			$("#edit_emplastinstitutionname").val(
				data.Editlastemployeementvalues.emp_lastinstitutionname
			);
			$("#edit_emplastdesignation").val(
				data.Editlastemployeementvalues.emp_lastdesignation
			);
			$("#edit_empfromlastexpyear").val(
				data.Editlastemployeementvalues.emp_fromlastexperienceyear
			);
			$("#edit_emptolastexpyear").val(
				data.Editlastemployeementvalues.emp_tolastexperienceyear
			);
			$("#edit_emplastexperiencesalary").val(
				data.Editlastemployeementvalues.emp_lastexperiencesalary
			);

			$("#edit_emphouserent").val(data.empeditallowancevalues.emp_houserent);
			$("#edit_empmedicalallowance").val(
				data.empeditallowancevalues.emp_medicalallowance
			);
			$("#edit_empcitycompensatory").val(
				data.empeditallowancevalues.emp_citycompensatory
			);
			$("#edit_empdearnessallowance").val(
				data.empeditallowancevalues.emp_dearnessallowance
			);
			$("#edit_empspecialallowance").val(
				data.empeditallowancevalues.emp_specialallowance
			);

			$("#edit_emptimeofincrement").val(
				data.editempincrementvalues.emp_timeofincrement
			);
			$("#edit_empbeforeincrement").val(
				data.editempincrementvalues.emp_beforeincrement
			);
			$("#edit_empincrementpercentage").val(
				data.editempincrementvalues.emp_incrementpercentage
			);
			$("#edit_empafterincrement").val(
				data.editempincrementvalues.emp_afterincrement
			);

			$("#edit_empsocietyid").val(data.editempcurrentvalues.emp_societyid);
			$("#edit_empschoolid").val(data.editempcurrentvalues.emp_schoolid);
			$("#edit_emptotalservingtime").val(
				data.editempcurrentvalues.emp_totalservingtime
			);
			$("#edit_empipnumber").val(data.editempcurrentvalues.emp_ipnumber);

			$("#edit_empdepartmentid").val(
				data.editempcurrentvalues.emp_departmentid
			);
			$("#edit_empdesignationid").val(
				data.editempcurrentvalues.emp_designationid
			);

			$("#edit_empexpertsubjectid").val(
				data.editempcurrentvalues.emp_expertsubjectid
			);

			$("#edit_empshifttype").val(data.editempcurrentvalues.emp_shifttype);
		},
	});
}

//.....................edit emp end................................................................//

//...................................Approve_leave..................//
function Approve_leave(applyleave_id) {
	$.ajax({
		url: base_url + "MasterAdmin/Approveleaves",
		data: { applyleave_id: applyleave_id },
		type: "POST",
		success: function (data) {
			console.log(data);
			var data = JSON.parse(data);
			$("#approve_applyleaveid").val(data.approvleavedata.applyleave_id);
			$("#approve_leavereason").val(data.approvleavedata.leave_reason);
		},
	});
}
//......................................Approve_leave end..............//

//...................................Reject_leave..................//
function Reject_leave(applyleave_id) {
	$.ajax({
		url: base_url + "MasterAdmin/Leavereject",
		data: { applyleave_id: applyleave_id },
		type: "POST",
		success: function (data) {
			console.log(data);
			var data = JSON.parse(data);
			$("#reject_applyleaveid").val(data.rejectleavedata.applyleave_id);
			$("#reject_leavereason").val(data.rejectleavedata.leave_reason);
		},
	});
}
//......................................Reject_leave end............................//

//...................................exit-form status start.........................//

function exitformviewstatus(exit_id) {
	$.ajax({
		url: base_url + "MasterAdmin/ExitStatusemp",
		data: { exit_id: exit_id },
		type: "POST",
		success: function (data) {
			console.log(data);
			var data = JSON.parse(data);
			$("#Showview_empname").html(data.employeeexitname);
			$("#Showview_empjoiningdate").html(data.empjoiningdate);
			$("#Showview_leaveorganisation").html(data.leaveorganisation);
			$("#Showview_leavingreason").html(data.leavingreason);
			$("#Showview_exitequires").html(data.exiempformrequires);
			$("#Showview_empnegotiation").html(data.empnegotiation);
			$("#Servingtimeshow").html(data.empservingtime);
			$("#Showempschname").html(data.empschname);
			$("#Emplastsalry").html(data.emplastsalary);
		},
	});
}

//....................................exit-form status end................................//
//..........................................view student.........................................
function showViewdivstudent(student_id) {
	$.ajax({
		url: base_url + "MasterAdmin/studentviewprofile",
		data: { student_id: student_id },
		type: "POST",
		success: function (data) {
			console.log(data);
			var data = JSON.parse(data);

			$("#StudentId").val(data.viewstudentprofile.student_id);
			$("#StudentAdmissionId").html(data.viewstudentprofile.Admissionid);
			$("#Studentprofilename").html(data.viewstudentprofile.stu_firstname);
			$("#StuprofileAdmissiondate").html(
				data.viewstudentprofile.stu_admissiondate
			);
			$("#studob").html(data.viewstudentprofile.stu_dob);
			$("#stugender").html(data.viewstudentprofile.stu_gender);
			$("#studentage").html(data.viewstudentprofile.stu_age);
			$("#studentreligionid").html(data.viewstudentprofile.stu_religionid);
			$("#stucasteid").html(data.viewstudentprofile.stu_casteid);
			$("#stunationality").html(data.viewstudentprofile.stu_nationality);
			$("#stumothertongue").html(data.viewstudentprofile.stu_mothertongue);

			$("#stubloodgroup").html(data.viewstudentprofile.stu_bloodgroup);

			$("#studentadhaarnumber").html(data.viewstudentprofile.stu_adhaarnumber);

			$("#studentsssmid").html(data.viewstudentprofile.stu_sssmid);

			$("#studentspeciallyabled").html(
				data.viewstudentprofile.stu_speciallyabled
			);

			$("#stufathername").html(data.studentdetail.stu_fathername);

			$("#stufathercontact").html(data.studentdetail.stu_fathermobileno);

			$("#stufatheremail").html(data.studentdetail.stu_fatheremail);

			$("#stufatheraadharno").html(data.studentdetail.stu_fatheraadharno);

			$("#stufatheraadharno").html(data.studentdetail.stu_fatheraadharno);

			$("#stufatherqualification").html(
				data.studentdetail.stu_fatherqualification
			);

			$("#stufatheroccupation").html(data.studentdetail.stu_fatheroccupation);

			$("#stumothername").html(data.studentdetail.stu_mothername);

			$("#stumothermobileno").html(data.studentdetail.stu_mothermobileno);

			$("#stumotheremail").html(data.studentdetail.stu_motheremail);

			$("#stumotheraadharno").html(data.studentdetail.stu_motheraadharno);

			$("#stumotherqualification").html(
				data.studentdetail.stu_motherqualification
			);

			$("#stumotheroccupation").html(data.studentdetail.stu_motheroccupation);

			$("#stusiblingsname").html(data.studentdetail.stu_siblingsname);

			$("#stusiblingsenrollmentnumber").html(
				data.studentdetail.stu_siblingsenrollmentnumber
			);

			$("#stulocalguardianname").html(
				data.stuguardiandetail.localguardian_name
			);

			$("#stuguardianmobileno").html(data.stuguardiandetail.guardian_mobileno);

			$("#stuguardianemail").html(data.stuguardiandetail.guardian_email);

			$("#stuguardianrelationwithstudent").html(
				data.stuguardiandetail.guardian_relationwithstudent
			);

			$("#stulocalguardianaddress").html(
				data.stuguardiandetail.localguardian_address
			);

			$("#stuguardianaadharno").html(data.stuguardiandetail.guardian_aadharno);
		},
	});
}
//.........................................view student end......................................//

//.........................assign timetable.........................................
function Assigntimetable(set_id) {
	$.ajax({
		url: base_url + "MasterAdmin/timetableData",
		data: { set_id: set_id },
		type: "POST",
		success: function (data) {
			console.log(data);
			var data = JSON.parse(data);
			$("#shiftstarttime").html(data.settblvalues.set_shift_starttime);
			$("#shiftendtime").html(data.settblvalues.set_shift_endtime);
			$("#showshiftname").html(data.timetable_shiftname);
		},
	});
}

//.............................assign timetable end.....................................//

//............................account_setup end..................................//

//..............................vendor starting.......................................................//

//................................vendor ending......................................................//

//...........................................purchase setup end................................//

//...........................................Library SetUp Starting..............................//

//............................................Edition update start........................//
function updateedition(edition_id) {
	$.ajax({
		url: base_url + "MasterAdmin/Editionupdatedata",
		data: { edition_id: edition_id },
		type: "POST",
		success: function (data) {
			console.log(data);
			var data = JSON.parse(data);
			$("#Edit_editionid").val(data.dataupdateedition.edition_id);
			$("#Edit_editionname").val(data.dataupdateedition.edition_name);
		},
	});
}
//............................................Edition update end..........................//
//...........................................book category update start...................//
function updatebookcategory(book_category_id) {
	$.ajax({
		url: base_url + "MasterAdmin/Bookcategoryupdatedata",
		data: { book_category_id: book_category_id },
		type: "POST",
		success: function (data) {
			console.log(data);
			var data = JSON.parse(data);
			$("#Edit_bookcategoryid").val(
				data.dataupdatebookcategory.book_category_id
			);
			$("#Edit_bookcategoryname").val(
				data.dataupdatebookcategory.book_category_name
			);
		},
	});
}
//...........................................book category update end......................//
//...........................................book language update start.....................//
function updatebooklanguage(book_language_id) {
	$.ajax({
		url: base_url + "MasterAdmin/Booklanguageupdatedata",
		data: { book_language_id: book_language_id },
		type: "POST",
		success: function (data) {
			console.log(data);
			var data = JSON.parse(data);
			$("#Edit_booklanguageid").val(
				data.dataupdatebooklanguage.book_language_id
			);
			$("#Edit_booklanguagename").val(
				data.dataupdatebooklanguage.book_language_name
			);
		},
	});
}
//...........................................book language update end.......................//

//............................................library fine update start......................//
function updatelibraryfine(library_fine_id) {
	$.ajax({
		url: base_url + "MasterAdmin/Libraryfineupdatedata",
		data: { library_fine_id: library_fine_id },
		type: "POST",
		success: function (data) {
			console.log(data);
			var data = JSON.parse(data);
			$("#Edit_libraryfineid").val(data.dataupdatelibraryfine.library_fine_id);
			$("#Edit_libraryfinetype").val(
				data.dataupdatelibraryfine.library_fine_type
			);
			$("#Edit_libraryfineamt").val(
				data.dataupdatelibraryfine.library_fine_amt
			);
		},
	});
}

//.............................................library fine update end.........................//

//...............................................library room update start.....................//
function updatelibraryroom(library_room_id) {
	$.ajax({
		url: base_url + "MasterAdmin/Libraryroomupdatedata",
		data: { library_room_id: library_room_id },
		type: "POST",
		success: function (data) {
			console.log(data);
			var data = JSON.parse(data);
			$("#Edit_libraryroomid").val(data.dataupdatelibraryroom.library_room_id);
			$("#Edit_llibraryroomno").val(data.dataupdatelibraryroom.library_room_no);
		},
	});
}
//...............................................library room update end......................//
//................................................library row update start....................//
function librowupdate(library_row_id) {
	$.ajax({
		url: base_url + "MasterAdmin/Libraryrowupdatedata",
		data: { library_row_id: library_row_id },
		type: "POST",
		success: function (data) {
			console.log(data);
			var data = JSON.parse(data);
			$("#Edit_libraryrowid").val(data.dtaupdtelibrowu.library_row_id);
			$("#Edit_libraryrowlibroomid").val(
				data.dtaupdtelibrowu.libraryrow_lib_room_id
			);
			$("#Edit_libraryrowno").val(data.dtaupdtelibrowu.library_row_no);
		},
	});
}
//.................................................library row update end.......................//
//..................................................lib shelf update start......................//
function libupdateshelf(shelf_id) {
	$.ajax({
		url: base_url + "MasterAdmin/Shelfupdatedata",
		data: { shelf_id: shelf_id },
		type: "POST",
		success: function (data) {
			console.log(data);
			var data = JSON.parse(data);
			$("#Edit_shelfid").val(data.updateshelfdta.shelf_id);
			$("#Edit_shelfroom").val(data.updateshelfdta.shelf_room);
			$("#Edit_shelfrow").val(data.updateshelfdta.shelf_row);
			$("#Edit_shelfno").val(data.updateshelfdta.shelf_no);
		},
	});
}
//..................................................lib shelf update end........................//
//...................................................lib rack update start.....................//
function updaterack(rack_id) {
	$.ajax({
		url: base_url + "MasterAdmin/Rackdataupdate",
		data: { rack_id: rack_id },
		type: "POST",
		success: function (data) {
			console.log(data);
			var data = JSON.parse(data);
			$("#Edit_rackid").val(data.dtaupdaterack.rack_id);
			$("#Edit_rackroom").val(data.dtaupdaterack.rack_room);
			$("#Edit_rackrow").val(data.dtaupdaterack.rack_row);
			$("#Edit_rackshelf").val(data.dtaupdaterack.rack_shelf);
			$("#Edit_rackno").val(data.dtaupdaterack.rack_no);
		},
	});
}
//...................................................lib rack update end........................//
//...........................................Library SetUp Ending.................................//

//..............................................Qualification-type update start...........................//
function updatequalificationtype(qualification_id) {
	$.ajax({
		url: base_url + "MasterAdmin/Qualificationupdatedta",
		data: { qualification_id: qualification_id },
		type: "POST",
		success: function (data) {
			console.log(data);
			var data = JSON.parse(data);
			$("#Edit_qualificationid").val(
				data.dtaupdatequalification.qualification_id
			);
			$("#Edit_qualificationtypename").val(
				data.dtaupdatequalification.qualification_type_name
			);
			$("#Edit_qualificationname").val(
				data.dtaupdatequalification.qualification_name
			);
		},
	});
}
//..............................................Qualification-type update end........................//

//...............................................scholarship-category update start.....................//
function updatescholarcategory(scholarship_category_id) {
	$.ajax({
		url: base_url + "MasterAdmin/Scholarshipcategoryupdatedata",
		data: { scholarship_category_id: scholarship_category_id },
		type: "POST",
		success: function (data) {
			console.log(data);
			var data = JSON.parse(data);
			$("#Edit_scholarshipcategoryid").val(
				data.updatescholarshipcategorydta.scholarship_category_id
			);
			$("#Edit_scholarshipcategoryname").val(
				data.updatescholarshipcategorydta.scholarship_category_name
			);
		},
	});
}
//................................................scholarship-category update end......................//

//.................................................job-description update start.........................//
function updatejobdesc(job_description_id) {
	$.ajax({
		url: base_url + "MasterAdmin/Jobdescupdatedata",
		data: { job_description_id: job_description_id },
		type: "POST",
		success: function (data) {
			console.log(data);
			var data = JSON.parse(data);
			$("#Edit_jobdescriptionid").val(
				data.updatejobdescData.job_description_id
			);
			$("#Edit_jobdescdesignationid").val(
				data.updatejobdescData.job_desc_designation_id
			);
			$("#Edit_jobdescriptionname").val(
				data.updatejobdescData.job_description_name
			);
		},
	});
}
//..................................................job-description update end...........................//

//...................................................scholarship view start................................//
function viewscholar(scholarships_id) {
	$.ajax({
		url: base_url + "MasterAdmin/Scholarviewdata",
		data: { scholarships_id: scholarships_id },
		type: "POST",
		success: function (data) {
			console.log(data);
			var data = JSON.parse(data);
			$("#View_scholarshipsid").val(data.viewscholardta.scholarships_id);
			$("#View_scholaracdemicid").val(data.viewscholardta.scholar_acdemic_id);
			$("#View_scholarshipname").html(data.viewscholardta.scholarship_name);
			$("#View_scholarshipprovider").html(
				data.viewscholardta.scholarship_provider
			);

			$("#View_percentagecriteria").html(
				data.viewscholardta.percentage_criteria
			);

			$("#View_studenttype").html(data.viewscholardta.student_type);

			$("#View_maximumamount").html(data.viewscholardta.maximum_amount);

			$("#View_acdmicyear").html(data.acdmicyear);

			$("#View_applicationdate").html(data.application_date);

			$("#View_classlistnameshow").html(data.classlistnameshow);
		},
	});
}
//....................................................scholarship view end...........................//
