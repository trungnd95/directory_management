<!DOCTYPE html>
<html lang="en">
    @include("partials.head")
    <body class="homepage">
        <div class="container">
			<header>
				<h2 class="text-center">Directory Management</h2>
			</header>
			
			<section class="main">
			
				<ul class="ch-grid">
					<li>
						<div class="ch-item ch-img-1">				
							<div class="ch-info-wrap">
								<div class="ch-info">
									<div class="ch-info-front ch-img-1"></div>
									<div class="ch-info-back">
										<a  class="text-center inside-link" href="{{route('departments.index')}}">Departments</a>
									</div>	
								</div>
							</div>
						</div>
					</li>
					<li>
						<div class="ch-item ch-img-2">
							<div class="ch-info-wrap">
								<div class="ch-info">
									<div class="ch-info-front ch-img-2"></div>
									<div class="ch-info-back">
										<a  class="text-center inside-link" href="{{route('employees.index')}}">Employees</a>
									</div>
								</div>
							</div>
						</div>
					</li>
					<li>
						<div class="ch-item ch-img-3">
							<div class="ch-info-wrap">
								<div class="ch-info">
									<div class="ch-info-front ch-img-3"></div>
									<div class="ch-info-back">
										<a  class="text-center inside-link" href="{{url( '/login') }}">Login</a>
									</div>
								</div>
							</div>
						</div>
					</li>
				</ul>
				
			</section>
        </div>
        @include("partials.script")
    </body>
</html>