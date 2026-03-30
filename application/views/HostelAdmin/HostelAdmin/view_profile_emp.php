    <!-- View Employee Profile -->
<div class="content_wrapper">
	<div id="view_profile_emp" class="myDiv">
		<div class="row">
			<div class="col d-flex">
				<h4 class="sub-heading">
					<span class="underline"><b>My Profile</b>
						<i class="fa-solid fa-circle"></i></span>
				</h4>
                <nav aria-label="breadcrumb" class="ms-3">
					<ol class="breadcrumb justify-content-end">
						<li class="breadcrumb-item"><a href=""><img height="15" width="15" class="mb-1" src="<?php echo base_url('assets/images/schoolicon2.png'); ?>"></a></li>
						<li class="breadcrumb-item active" aria-current="page">My Profile</li>
					</ol>
				</nav>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3">
				<div class="card profile-card p-3">
					<div class="image d-flex flex-column justify-content-center align-items-center">
						<button class="btn btn-secondary">
							<img src="https://i.imgur.com/wvxPV9S.png" height="100" width="100" />
						</button>
						<span class="name mt-3" id="empname"></span>
						<span class="idd">Registration No1003</span>
						<div class="d-flex flex-row justify-content-center align-items-center gap-2">
							<span class="idd1">Employee ID</span>
							<span><i class="fa fa-copy"></i></span>
						</div>
						<ul class="d-flex flex-column justify-content-center align-items-center mt-3">
							<li>
								<a href="" class="number"><i class="fas fa-phone-square-alt"></i> <span class="follow">7000375743</span></a>
							</li>
							<li>
								<a href="" class="number"><i class="far fa-envelope"></i> <span class="follow">darshankul@gmail.com</span></a>
							</li>
						</ul>
						<div class="text-start border-bottom w-100 mt-3">
							<h6>View Documents</h6>
						</div>
						<div class="mt-2 w-100">
							<div class="border d-flex gap-2 justify-content-between align-items-center">
								<div>
									<i class="far fa-file-pdf ms-2"></i> Addhar Card
								</div>
								<button class="btn"><i class="fas fa-file-download"></i></button>
							</div>
							<div class="border d-flex gap-2 justify-content-between align-items-center mt-2">
								<div>
									<i class="far fa-file-pdf ms-2"></i> Pan Card
								</div>
								<button class="btn"><i class="fas fa-file-download"></i></button>
							</div>
							<div class="border d-flex gap-2 justify-content-between align-items-center mt-2">
								<div>
									<i class="far fa-file-pdf ms-2"></i> Experience Letter
								</div>
								<button class="btn"><i class="fas fa-file-download"></i></button>
							</div>
						</div>
						<div class="gap-3 mt-3 icons d-flex flex-row justify-content-center align-items-center">
							<span><i class="fa fa-twitter"></i></span>
							<span><i class="fa fa-facebook-f"></i></span>
							<span><i class="fa fa-instagram"></i></span>
							<span><i class="fa fa-linkedin"></i></span>
						</div>
						<div class="row row-cols-auto align-items-center mt-4">
							<div class="rounded join_date py-1">
								<span class="join">Joined May,2021</span>
							</div>
							<button class="btn">Edit Profile</button>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-9">
				<ul class="nav nav-tabs profile_tabs_menu" id="myTab" role="tablist">
					<li class="nav-item" role="presentation">
						<button class="nav-link active" id="Personal-tab" data-bs-toggle="tab" data-bs-target="#Personal-tab-pane" type="button" role="tab" aria-controls="Personal-tab-pane" aria-selected="true">
							Personal
						</button>
					</li>
					<li class="nav-item" role="presentation">
						<button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#Academic-tab-pane" type="button" role="tab" aria-controls="Academic-tab-pane" aria-selected="false">
							Academic
						</button>
					</li>
					<li class="nav-item" role="presentation">
						<button class="nav-link" id="Experience-tab" data-bs-toggle="tab" data-bs-target="#Experience-tab-pane" type="button" role="tab" aria-controls="Experience-tab-pane" aria-selected="false">
							Experience
						</button>
					</li>
					<li class="nav-item" role="presentation">
						<button class="nav-link" id="Bank-tab" data-bs-toggle="tab" data-bs-target="#Bank-tab-pane" type="button" role="tab" aria-controls="Bank-tab-pane" aria-selected="false">
							Bank Details
						</button>
					</li>
				</ul>
				<div class="tab-content" id="myTabContent">
					<div class="tab-pane fade show active" id="Personal-tab-pane" role="tabpanel" aria-labelledby="Personal-tab" tabindex="0">
						<div class="row d-flex">
							<div class="col-6">
								<div class="card p-3 m-2">
									<div class="row">
										<div class="col-5 text-start schl-text-green">
											Registration No.
										</div>
										<div class="col"><span id=""></span></div>
									</div>
									<div class="row">
										<div class="col-5 text-start schl-text-green">
											Date Of Joining
										</div>
										<div class="col"><span id="Joinemp"></span></div>
									</div>
									<div class="row">
										<div class="col-5 text-start schl-text-green">Date Of Birth :</div>
										<div class="col"><span id="empdob"></span></div>
									</div>
									<div class="row">
										<div class="col-5 text-start schl-text-green">Gender :</div>
										<div class="col"><span id="empgendershow"></span></div>
									</div>
									<div class="row">
										<div class="col-5 text-start schl-text-green">Age :</div>
										<div class="col"><span id="ageempshow"></span></div>
									</div>
									<div class="row">
										<div class="col-5 text-start schl-text-green">Religion :</div>
										<div class="col"><span id="empshowreligion"></span></div>
									</div>
									<div class="row">
										<div class="col-5 text-start schl-text-green">Caste :</div>
										<div class="col"><span id="showcasteemp"></span></div>
									</div>
									<div class="row">
										<div class="col-5 text-start schl-text-green">Nationality :</div>
										<div class="col"><span id="empshownationality"></span></div>
									</div>
									<div class="row">
										<div class="col-5 text-start schl-text-green">Mother Tongue :</div>
										<div class="col-1"></div>
										<div class="col"><span id="empshowmothertongue"></span></div>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="card p-3 m-2">
									<div class="row">
										<div class="col-5 text-start schl-text-green">Address1 :</div>
										<div class="col"><span id="showaddressemp"></span></div>
									</div>
									<div class="row">
										<div class="col-5 text-start schl-text-green">Address2 :</div>
										<div class="col"><span id="showaddressemp"></span></div>
									</div>
									<div class="row">
										<div class="col"> &nbsp;</div>
									</div>
									<div class="row">
										<div class="col-5 text-start schl-text-green">Blood Group :</div>
										<div class="col"><span id="showbloodemp"></span></div>
									</div>
									<div class="row">
										<div class="col-5 text-start schl-text-green">Marital Status :</div>
										<div class="col"><span id=""></span></div>
									</div>
									<div class="row">
										<div class="col-5 text-start schl-text-green">Adhaar No :</div>
										<div class="col"><span id="addharshowemp"></span></div>
									</div>
									<div class="row">
										<div class="col-5 text-start schl-text-green">SSSM Id :</div>
										<div class="col"><span id="showssmidno"></span></div>
									</div>
									<div class="row">
										<div class="col-5 text-start schl-text-green">Pan No :</div>
										<div class="col"><span id="showpannoemp"></span></div>
									</div>
									<div class="row">
										<div class="col-5 text-start schl-text-green">Emp. PF. No. :</div>
										<div class="col"><span id="showpfnoemp"></span></div>
									</div>
									<div class="row">
										<div class="col-5 text-start schl-text-green">ESIC No. :</div>
										<div class="col"><span id="showesicnoemp"></span></div>
									</div>
								</div>
							</div>
						</div>
						<div class="row d-flex">
							<div class="col-6">
								<div class="card p-3 m-2">
									<div class="card-header schl-text-green card-profile-head">
										Father’s/Spouse Detail
									</div>
									<div class="row">
										<div class="col-5 text-start schl-text-green">Name :</div>
										<div class="col"><span id="showspousenameemp"></span></div>
									</div>
									<div class="row">
										<div class="col-5 text-start schl-text-green">Contact No. :</div>
										<div class="col"><span id="showspousecont"></span></div>
									</div>
									<div class="row">
										<div class="col-5 text-start schl-text-green">Date of Birth :</div>
										<div class="col"><span id="empdeatailfatherdob"></span></div>
									</div>
									<div class="row">
										<div class="col-5 text-start schl-text-green">Email Address :</div>
										<div class="col"><span id="empdeatailfatheremail"></span></div>
									</div>
									<div class="row">
										<div class="col-5 text-start schl-text-green">Adhaar No. :</div>
										<div class="col"><span id="empdeatailfatheradhar"></span></div>
									</div>
									<div class="row">
										<p>&nbsp;</p>
									</div>
									<div class="row">
										<p>&nbsp;</p>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="card p-3 m-2">
									<div class="card-header schl-text-green card-profile-head">
										Emergency Detail
									</div>
									<div class="row">
										<div class="col-5 text-start schl-text-green">Name :</div>
										<div class="col"><span id="showempemergencyname"></span></div>
									</div>
									<div class="row">
										<div class="col-5 text-start schl-text-green">Contact No. :</div>
										<div class="col"><span id="showempemergencycont"></span></div>
									</div>
									<div class="row">
										<div class="col-5 text-start schl-text-green">Date of Birth :</div>
										<div class="col"><span id="showspouseemail"></span></div>
									</div>
									<div class="row">
										<div class="col-5 text-start schl-text-green">Email Address :</div>
										<div class="col"><span id="empdeatailemremail"></span></div>
									</div>
									<div class="row">
										<div class="col-5 text-start schl-text-green">Adhaar No. :</div>
										<div class="col"><span id="empdeatailemraadhar"></span></div>
									</div>
									<div class="row">
										<div class="col-5 text-start schl-text-green">Address :</div>
										<div class="col"><span id="empdeatailemraddress"></span></div>
									</div>
									<div class="row">
										<div class="col-5 text-start schl-text-green">Relation :</div>
										<div class="col"><span id="showempemergencyrelation"></span></div>
									</div>
								</div>
							</div>
						</div>
						<div class="card p-3 m-2">
							<div class="col-5 text-start schl-text-green">Documents Attached :</div>
							<div class="col"><span id="showattacheddocuments"></span></div>
							<div class="col text-end">
								<button type="button" class="btn schl-btn-white">
									<i class="fa fa-eye" aria-hidden="true"></i> View Documents
								</button>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="Academic-tab-pane" role="tabpanel" aria-labelledby="Academic-tab" tabindex="0">
						<div class="row d-flex">
							<div class="col-6">
								<div class="card p-3 m-2">
									<div class="card-header schl-text-green card-profile-head">
										Post Graduation Details
									</div>
									<div class="row">
										<div class="col-5 text-start schl-text-green">Year Passing :</div>
										<div class="col"><span id="EmpPostGraduationYearname"></span></div>
									</div>
									<div class="row">
										<div class="col-5 text-start schl-text-green">University :</div>
										<div class="col"><span id="postunivercityemp"></span></div>
									</div>
									<div class="row">
										<div class="col-5 text-start schl-text-green">Institute Name :</div>
										<div class="col"><span id="postinsname"></span></div>
									</div>
									<div class="row">
										<div class="col-5 text-start schl-text-green">Course Name :</div>
										<div class="col"><span id="postcource"></span></div>
									</div>
									<div class="row">
										<div class="col-5 text-start schl-text-green">Marks Obtained</div>
										<div class="col"><span id="postmarks"></span></div>
									</div>
									<div class="row">
										<div class="col-5 text-start schl-text-green">Percentage :</div>
										<div class="col"><span id=""></span></div>
									</div>
									<div class="row">
										<div class="col">&nbsp;</div>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="card p-3 m-2">
									<div class="card-header schl-text-green card-profile-head">
										Graduation Details
									</div>
									<div class="row">
										<div class="col-5 text-start schl-text-green">Year Passing :</div>
										<div class="col"><span id="passingyeargraduemp"></span></div>
									</div>
									<div class="row">
										<div class="col-5 text-start schl-text-green">University :</div>
										<div class="col"><span id="graduunivercity"></span></div>
									</div>
									<div class="row">
										<div class="col-5 text-start schl-text-green">Institute Name :</div>
										<div class="col"><span id="graduuniinst"></span></div>
									</div>
									<div class="row">
										<div class="col-5 text-start schl-text-green">Course Name :</div>
										<div class="col"><span id="graducourcesubject"></span></div>
									</div>
									<div class="row">
										<div class="col-5 text-start schl-text-green">Marks Obtained</div>
										<div class="col"><span id="gradumarks"></span></div>
									</div>
									<div class="row">
										<div class="col-5 text-start schl-text-green">Percentage :</div>
										<div class="col"><span id=""></span></div>
									</div>
									<div class="row">
										<div class="col">&nbsp;</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row d-flex">
							<div class="col-6">
								<div class="card p-3 m-2">
									<div class="card-header schl-text-green card-profile-head">
										<span>12<sup>th</sup>&nbsp;Detail</span>
									</div>
									<div class="row">
										<div class="col-5 text-start schl-text-green">Year Passing :</div>
										<div class="col"><span id="passingyear12th"></span></div>
									</div>
									<div class="row">
										<div class="col-5 text-start schl-text-green">Board :</div>
										<div class="col"><span id="board12thname"></span></div>
									</div>
									<div class="row">
										<div class="col-5 text-start schl-text-green">Course Name :</div>
										<div class="col"><span id="subjectname12th"></span></div>
									</div>
									<div class="row">
										<div class="col-5 text-start schl-text-green">Marks Obtained</div>
										<div class="col"><span id="marks12th"></span></div>
									</div>
									<div class="row">
										<div class="col-5 text-start schl-text-green">Percentage :</div>
										<div class="col"><span id=""></span></div>
									</div>
									<div class="row">
										<div class="col">&nbsp;</div>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="card p-3 m-2">
									<div class="card-header schl-text-green card-profile-head">
										<span>10<sup>th</sup> &nbsp;Detail</span>
									</div>
									<div class="row">
										<div class="col-5 text-start schl-text-green">Year Passing :</div>
										<div class="col"><span id="passingyear10th"></span></div>
									</div>
									<div class="row">
										<div class="col-5 text-start schl-text-green">Board :</div>
										<div class="col"><span id="board10thname"></span></div>
									</div>
									<div class="row">
										<div class="col-5 text-start schl-text-green">Subjects :</div>
										<div class="col"><span id="subjectname10th"></span></div>
									</div>
									<div class="row">
										<div class="col-5 text-start schl-text-green">Marks Obtained</div>
										<div class="col"><span id="marks10th"></span></div>
									</div>
									<div class="row">
										<div class="col-5 text-start schl-text-green">Percentage :</div>
										<div class="col"><span id=""></span></div>
									</div>
									<div class="row">
										<div class="col">&nbsp;</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="Experience-tab-pane" role="tabpanel" aria-labelledby="Experience-tab" tabindex="0">
						<div class="row d-flex">
							<div class="col-6">
								<div class="card p-3 m-2">
									<div class="card-header schl-text-green card-profile-head">
										Working Experience
									</div>
									<div class="row">
										<div class="col-5 text-start schl-text-green">Last Institution Name </div>
										<div class="col"><span id="lastinsemp"></span></div>
									</div>
									<div class="row">
										<div class="col-5 text-start schl-text-green">Last Designation</div>
										<div class="col"><span id="lastdesignationemp"></span></div>
									</div>
									<div class="row">
										<div class="col-5 text-start schl-text-green">From Month-Year</div>
										<div class="col"><span id="lastfromyear"></span></div>
									</div>
									<div class="row">
										<div class="col-5 text-start schl-text-green">To Month-Year</div>
										<div class="col"><span id="lasttoyear"></span></div>
									</div>
									<div class="row">
										<div class="col-5 text-start schl-text-green">salary</div>
										<div class="col"><span id="salarylastemp"></span></div>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="card p-3 m-2">
									<div class="card-header schl-text-green card-profile-head">
										Working Experience
									</div>
									<div class="row">
										<div class="col-5 text-start schl-text-green">Last Institution Name</div>
										<div class="col"><span id=""></span></div>
									</div>
									<div class="row">
										<div class="col-5 text-start schl-text-green">Last Designation</div>
										<div class="col"><span id=""></span></div>
									</div>
									<div class="row">
										<div class="col-5 text-start schl-text-green">From Month-Year</div>
										<div class="col"><span id=""></span></div>
									</div>
									<div class="row">
										<div class="col-5 text-start schl-text-green">To Month-Year</div>
										<div class="col"><span id="lasttoyear"></span></div>
									</div>
									<div class="row">
										<div class="col-5 text-start schl-text-green">salary</div>
										<div class="col"><span id=""></span></div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="Bank-tab-pane" role="tabpanel" aria-labelledby="Bank-tab" tabindex="0">
						<div class="row d-flex">
							<div class="col-6">
								<div class="card m-2">
									<div class="card-header schl-text-green">
										Bank Details
									</div>
									<div class="row ms-1">
										<div class="col-5 text-start schl-text-green">Acc. Holder Name</div>
										<div class="col"></div>
									</div>
									<div class="row ms-1">
										<div class="col-5 text-start schl-text-green">Bank Name</div>
										<div class="col"></div>
									</div>
									<div class="row ms-1">
										<div class="col-5 text-start schl-text-green">Branch</div>
										<div class="col"></div>
									</div>
									<div class="row ms-1">
										<div class="col-5 text-start schl-text-green">City</div>
										<div class="col"></div>
									</div>
									<div class="row ms-1">
										<div class="col-5 text-start schl-text-green">Ach. Sub Category</div>
										<div class="col"></div>
									</div>
									<div class="row ms-1">
										<div class="col-5 text-start schl-text-green">Account No.</div>
										<div class="col"></div>
									</div>
									<div class="row ms-1">
										<div class="col-5 text-start schl-text-green">Bank IFSC Code</div>
										<div class="col"></div>
									</div>
								</div>
							</div>
							<div class="col-6">
								<div class="card m-2">
									<div class="card-header schl-text-green">
										Increment Details
									</div>
									<div class="row ms-1">
										<div class="col-5 text-start schl-text-green">Time Of Increment</div>
										<div class="col"></div>
									</div>
									<div class="row ms-1">
										<div class="col-5 text-start schl-text-green">Before</div>
										<div class="col"></div>
									</div>
									<div class="row ms-1">
										<div class="col-5 text-start schl-text-green">Increment %</div>
										<div class="col"> </div>
									</div>
									<div class="row ms-1">
										<div class="col-5 text-start schl-text-green">After</div>
										<div class="col"></div>
									</div>
								</div>
							</div>
						</div>
						<div class="row d-flex">
							<div class="col">
								<div class="card m-2">
									<div class="card-header schl-text-green">
										Salary Details
									</div>
									<div class="row">
										<div class="col-5 text-start schl-text-green"></div>
										<div class="col"> </div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
	<!-- Employee Profile end -->