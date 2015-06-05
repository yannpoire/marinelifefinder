<?php

class MLFLife {
    /**
     * The database object
     *
     * @var object
     */
    private $_db;

    /**
     * Checks for a database object and creates one if none is found
     *
     * @param object $db
     * @return void
     */
    public function __construct($db=NULL) {
        if(is_object($db)) {
            $this->_db = $db;
        } else {
            $dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME;
            $this->_db = new PDO($dsn, DB_USER, DB_PASS);
        }
    }
	
	public function showLife($url) {
		$sql = "SELECT * FROM mlf_pages WHERE pagealias= :pageurl LIMIT 1";
		try {
			$stmt = $this->_db->prepare($sql);
			$stmt->bindParam(':pageurl', $url, PDO::PARAM_STR);
			$stmt->execute();
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			$stmt->closeCursor();
			if (isset($result) && $result['pagestatus'] == 0) {
				echo "This is not published";
				$result = NULL;
				header("Location : index.php");
			} else {
				return $result;
			}
		} catch (PDOException $e) {
            return FALSE;
		}
	}
	
	public function fetchLife($scope) {
		if (empty($scope)) {
			$sql = "SELECT pagestatus, pagetitle, pagealias, pagecat, pagecontent, metadesc, metakeys, pageurl FROM mlf_pages GROUP BY pagetitle ASC";
		} else {
			$sql = "SELECT * FROM mlf_pages WHERE pagecat = :pagecat";
		}
		if ( $stmt = $this->_db->prepare($sql) ) {
			if (!empty($scope)) {
            	$stmt->bindParam(":pagecat", $scope, PDO::PARAM_STR);
			}
            $stmt->execute();
            $pages = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$stmt->closeCursor();
			return $pages;
		}
	}
	
	
	
	public function addFish() {
		// Check if exist
		$falias = $_POST['binomialfirst']."_".$_POST['binomiallast'];
		echo $falias;
		$unixtime = time();
		$sql = "SELECT falias FROM mlf_fish WHERE falias = :falias LIMIT 1";
		try {
			$stmt = $this->_db->prepare($sql);
			$stmt->bindParam(':falias', $_POST['falias'], PDO::PARAM_STR);
			$stmt->execute();
			$result = $stmt->fetch();
			$stmt->closeCursor();
			if (!empty($result)) {
				echo "This lifeform already exist in DB";
			} else {
				echo "Trying to create";
				$sql = "INSERT INTO mlf_fish(fstatus, falias, fcname, fothercnames, ffamilycname, fbinomialfirst, fbinomiallast, fclassification, fsummary, fcontent, fjuvdistinct, ffemdistinct, fprimarycolors, fsecondarycolors, fpatternsmarks, fgeneralshape, fjuvprimarycolors, fjuvsecondarycolors, fjuvpatternsmarks, fjuvgeneralshape, ffemprimarycolors, ffemsecondarycolors, ffempatternsmarks, ffemgeneralshape, fsize, 	fbodyrings, fheadshape, fheadsizetobody, fmouthshape, fmouthposition, fmouthsizetohead, fmouthreltoeyes, fmouthteethvis, feyessizetohead, feyesposition, flaterallinesshape, flaterallinespores, foperculums, fholes, fslits, fscalessize, fscalestype, flateralscales, ftraversescalesover, ftraversescalesunder, fpredorsalscales, fupperarmsrakers, flowerarmsrakers, fdorsalfinshape,fdorsalfinspatterns, fdorsalfinsplit, fdorsalfinretractable, fdorsalfinspines, fdorsalfinrays, fcaudalfinshape, fcaudalfintype, fcaudalfinpatterns, fcaudalfinspines, fcaudalfinrays, fanalfinsshape, fanalfinspatterns, fanalfinsspines, fanalfinsrays, fpelvicfinsshape, fpelvicfinspatterns, fpelvicfinsspines, fpelvicfinsrays, fpelvicfinsclaspers, fpelvicfinsfuseddisc, fpectoralfinsshape, fpectoralfinspatterns, fpectoralfinsspines, fpectoralfinsrays, fadiposefin, fabvertebraes, fcavertebraes, fschoolingsize, fschoolingdensity, fmotion, fdiet, ffeeding, ftimeactive, fcourting, fspecialbehavior, fhabitat, fhabitattype, fmigratory, fmigratorystart, fmigratoryend, foceans, fseas, fcontinents, fregions, fcountries, fimages, fimagesexternal, fvideos, fvideosexternal, ffishbaselink, fwikipedialink, fwormslink, fitislink, fpageurl, fmetadesc, fmetakeys, fcreated, fmodified, fusername) 
					
					VALUES (:fstatus, :falias, :fcname, :fothercnames, :ffamilycname, :fbinomialfirst, :fbinomiallast, :fclassification, :fsummary, :fcontent, :fjuvdistinct, :ffemdistinct, :fprimarycolors, :fsecondarycolors, :fpatternsmarks, :fgeneralshape, :fjuvprimarycolors, :fjuvsecondarycolors, :fjuvpatternsmarks, :fjuvgeneralshape, :ffemprimarycolors, :ffemsecondarycolors, :ffempatternsmarks, :ffemgeneralshape, :fsize, :fbodyrings, :fheadshape, :fheadsizetobody, :fmouthshape, :fmouthposition, :fmouthsizetohead, :fmouthreltoeyes, :fmouthteethvis, :feyessizetohead, :feyesposition, :flaterallinesshape, :flaterallinespores, :foperculums, :fholes, :fslits, :fscalessize, :fscalestype, :flateralscales, :ftraversescalesover, :ftraversescalesunder, :fpredorsalscales, :fupperarmsrakers, :flowerarmsrakers, :fdorsalfinshape, :fdorsalfinspatterns, :fdorsalfinsplit, :fdorsalfinretractable, :fdorsalfinspines, :fdorsalfinrays, :fcaudalfinshape, :fcaudalfintype, :fcaudalfinpatterns, :fcaudalfinspines, :fcaudalfinrays, :fanalfinsshape, :fanalfinspatterns, :fanalfinsspines, :fanalfinsrays, :fpelvicfinsshape, :fpelvicfinspatterns, :fpelvicfinsspines, :fpelvicfinsrays, :fpelvicfinsclaspers, :fpelvicfinsfuseddisc, :fpectoralfinsshape, :fpectoralfinspatterns, :fpectoralfinsspines, :fpectoralfinsrays, :	fadiposefin, :fabvertebraes, :fcavertebraes, :fschoolingsize, :fschoolingdensity, :fmotion, :fdiet, :ffeeding, :ftimeactive, :fcourting, :fspecialbehavior, :fhabitat, :fhabitattype, :fmigratory, :fmigratorystart, :fmigratoryend, :foceans, :fseas, :fcontinents, :fregions, :fcountries, :fimages, :fimagesexternal, :fvideos, :fvideosexternal, :ffishbaselink, :fwikipedialink, :fwormslink, :fitislink, :fpageurl, :fmetadesc, :fmetakeys, :fcreated, :fmodified, :fusername) ";
					
				$stmt = $this->_db->prepare($sql);
				$stmt->bindParam(':fstatus', $_POST['status'], PDO::PARAM_STR);
				$stmt->bindParam(':falias', $falias, PDO::PARAM_STR);
				$stmt->bindParam(':fcname', $_POST['cname'], PDO::PARAM_STR);
				$stmt->bindParam(':fothercnames', $_POST['othercnames'], PDO::PARAM_STR);
				$stmt->bindParam(':ffamilycname', $_POST['familycname'], PDO::PARAM_STR);
				$stmt->bindParam(':fbinomialfirst', $_POST['fbinomialfirst'], PDO::PARAM_STR);
				$stmt->bindParam(':fbinomiallast', $_POST['binomiallast'], PDO::PARAM_STR);
				$stmt->bindParam(':fclassification', $_POST['classification'], PDO::PARAM_STR);
				$stmt->bindParam(':fsummary', $_POST['summary'], PDO::PARAM_STR);
				$stmt->bindParam(':fcontent', $_POST['content'], PDO::PARAM_STR);
				$stmt->bindParam(':fjuvdistinct', $_POST['juvdistinct'], PDO::PARAM_INT);
				$stmt->bindParam(':ffemdistinct', $_POST['femdistinct'], PDO::PARAM_INT);
				$stmt->bindParam(':fprimarycolors', $_POST['primarycolors'], PDO::PARAM_STR);
				$stmt->bindParam(':fsecondarycolors', $_POST['secondarycolors'], PDO::PARAM_STR);
				$stmt->bindParam(':fpatternsmarks', $_POST['patternsmarks'], PDO::PARAM_STR);
				$stmt->bindParam(':fgeneralshape', $_POST['generalshape'], PDO::PARAM_STR);
				$stmt->bindParam(':fjuvprimarycolors', $_POST['juvprimarycolors'], PDO::PARAM_STR);
				$stmt->bindParam(':fjuvsecondarycolors', $_POST['juvsecondarycolors'], PDO::PARAM_STR);
				$stmt->bindParam(':fjuvpatternsmarks', $_POST['juvpatternsmarks'], PDO::PARAM_STR);
				$stmt->bindParam(':fjuvgeneralshape', $_POST['juvgeneralshape'], PDO::PARAM_STR);
				$stmt->bindParam(':ffemprimarycolors', $_POST['femprimarycolors'], PDO::PARAM_STR);
				$stmt->bindParam(':ffemsecondarycolors', $_POST['femsecondarycolors'], PDO::PARAM_STR);
				$stmt->bindParam(':ffempatternsmarks', $_POST['fempatternsmarks'], PDO::PARAM_STR);
				$stmt->bindParam(':ffemgeneralshape', $_POST['femgeneralshape'], PDO::PARAM_STR);
				$stmt->bindParam(':fsize', $_POST['size'], PDO::PARAM_INT);
				$stmt->bindParam(':fbodyrings', $_POST['bodyrings'], PDO::PARAM_INT);
				$stmt->bindParam(':fheadshape', $_POST['headshape'], PDO::PARAM_STR);
				$stmt->bindParam(':fheadsizetobody', $_POST['headsizetobody'], PDO::PARAM_STR);
				$stmt->bindParam(':fmouthshape', $_POST['mouthshape'], PDO::PARAM_STR);
				$stmt->bindParam(':fmouthposition', $_POST['mouthposition'], PDO::PARAM_STR);
				$stmt->bindParam(':fmouthsizetohead', $_POST['mouthsizetohead'], PDO::PARAM_STR);
				$stmt->bindParam(':fmouthreltoeyes', $_POST['mouthreltoeyes'], PDO::PARAM_STR);
				$stmt->bindParam(':fmouthteethvis', $_POST['mouthteethvis'], PDO::PARAM_STR);
				$stmt->bindParam(':feyessizetohead', $_POST['eyessizetohead'], PDO::PARAM_STR);
				$stmt->bindParam(':feyesposition', $_POST['eyesposition'], PDO::PARAM_STR);
				$stmt->bindParam(':flaterallinesshape', $_POST['laterallinesshape'], PDO::PARAM_STR);
				$stmt->bindParam(':flaterallinespores', $_POST['laterallinespores'], PDO::PARAM_INT);
				$stmt->bindParam(':foperculums', $_POST['operculums'], PDO::PARAM_STR);
				$stmt->bindParam(':fholes', $_POST['holes'], PDO::PARAM_INT);
				$stmt->bindParam(':fslits', $_POST['slits'], PDO::PARAM_INT);
				$stmt->bindParam(':fscalessize', $_POST['scalessize'], PDO::PARAM_STR);
				$stmt->bindParam(':fscalestype', $_POST['fscalestype'], PDO::PARAM_STR);
				$stmt->bindParam(':flateralscales', $_POST['lateralscales'], PDO::PARAM_INT);
				$stmt->bindParam(':ftraversescalesover', $_POST['traversescalesover'], PDO::PARAM_INT);
				$stmt->bindParam(':ftraversescalesunder', $_POST['traversescalesunder'], PDO::PARAM_INT);
				$stmt->bindParam(':fpredorsalscales', $_POST['predorsalscales'], PDO::PARAM_INT);
				$stmt->bindParam(':fupperarmsrakers', $_POST['upperarmsrakers'], PDO::PARAM_STR);
				$stmt->bindParam(':flowerarmsrakers', $_POST['lowerarmsrakers'], PDO::PARAM_STR);
				$stmt->bindParam(':fdorsalfinshape', $_POST['dorsalfinshape'], PDO::PARAM_STR);
				$stmt->bindParam(':fdorsalfinspatterns', $_POST['dorsalfinspatterns'], PDO::PARAM_STR);
				$stmt->bindParam(':fdorsalfinsplit', $_POST['dorsalfinsplit'], PDO::PARAM_INT);
				$stmt->bindParam(':fdorsalfinretractable', $_POST['dorsalfinretractable'], PDO::PARAM_INT);
				$stmt->bindParam(':fdorsalfinspines', $_POST['dorsalfinspines'], PDO::PARAM_INT);
				$stmt->bindParam(':fdorsalfinrays', $_POST['dorsalfinrays'], PDO::PARAM_INT);
				$stmt->bindParam(':fcaudalfinshape', $_POST['caudalfinshape'], PDO::PARAM_STR);
				$stmt->bindParam(':fcaudalfintype', $_POST['caudalfintype'], PDO::PARAM_STR);
				$stmt->bindParam(':fcaudalfinpatterns', $_POST['caudalfinpatterns'], PDO::PARAM_STR);
				$stmt->bindParam(':fcaudalfinspines', $_POST['caudalfinspines'], PDO::PARAM_INT);
				$stmt->bindParam(':fcaudalfinrays', $_POST['caudalfinrays'], PDO::PARAM_INT);
				$stmt->bindParam(':fanalfinsshape', $_POST['analfinsshape'], PDO::PARAM_STR);
				$stmt->bindParam(':fanalfinspatterns', $_POST['analfinspatterns'], PDO::PARAM_STR);
				$stmt->bindParam(':fanalfinsspines', $_POST['analfinsspines'], PDO::PARAM_INT);
				$stmt->bindParam(':fanalfinsrays', $_POST['analfinsrays'], PDO::PARAM_INT);
				$stmt->bindParam(':fpelvicfinsshape', $_POST['pelvicfinsshape'], PDO::PARAM_STR);
				$stmt->bindParam(':fpelvicfinspatterns', $_POST['pelvicfinspatterns'], PDO::PARAM_STR);
				$stmt->bindParam(':fpelvicfinsspines', $_POST['pelvicfinsspines'], PDO::PARAM_INT);
				$stmt->bindParam(':fpelvicfinsrays', $_POST['pelvicfinsrays'], PDO::PARAM_INT);
				$stmt->bindParam(':fpelvicfinsclaspers', $_POST['pelvicfinsclaspers'], PDO::PARAM_INT);
				$stmt->bindParam(':fpelvicfinsfuseddisc', $_POST['pelvicfinsfuseddisc'], PDO::PARAM_INT);
				$stmt->bindParam(':fpectoralfinsshape', $_POST['pectoralfinsshape'], PDO::PARAM_STR);
				$stmt->bindParam(':fpectoralfinspatterns', $_POST['pectoralfinspatterns'], PDO::PARAM_STR);
				$stmt->bindParam(':fpectoralfinsspines', $_POST['pectoralfinsspines'], PDO::PARAM_INT);
				$stmt->bindParam(':fpectoralfinsrays', $_POST['pectoralfinsrays'], PDO::PARAM_INT);
				$stmt->bindParam(':fabvertebraes', $_POST['abvertebraes'], PDO::PARAM_INT);
				$stmt->bindParam(':fcavertebraes', $_POST['cavertebraes'], PDO::PARAM_INT);
				$stmt->bindParam(':fschoolingsize', $_POST['schoolingsize'], PDO::PARAM_STR);
				$stmt->bindParam(':fschoolingdensity', $_POST['schoolingdensity'], PDO::PARAM_STR);
				$stmt->bindParam(':fmotion', $_POST['motion'], PDO::PARAM_STR);
				$stmt->bindParam(':fdiet', $_POST['diet'], PDO::PARAM_STR);
				$stmt->bindParam(':ffeeding', $_POST['feeding'], PDO::PARAM_STR);
				$stmt->bindParam(':ftimeactive', $_POST['timeactive'], PDO::PARAM_STR);
				$stmt->bindParam(':fcourting', $_POST['courting'], PDO::PARAM_STR);
				$stmt->bindParam(':fspecialbehavior', $_POST['specialbehavior'], PDO::PARAM_STR);
				$stmt->bindParam(':fhabitat', $_POST['habitat'], PDO::PARAM_STR);
				$stmt->bindParam(':fhabitattype', $_POST['habitattype'], PDO::PARAM_STR);
				$stmt->bindParam(':fmigratory', $_POST['migratory'], PDO::PARAM_INT);
				$stmt->bindParam(':fmigratorystart', $_POST['migratorystart'], PDO::PARAM_STR);
				$stmt->bindParam(':fmigratoryend', $_POST['migratoryend'], PDO::PARAM_STR);
				$stmt->bindParam(':foceans', $_POST['oceans'], PDO::PARAM_STR);
				$stmt->bindParam(':fseas', $_POST['seas'], PDO::PARAM_STR);
				$stmt->bindParam(':fcontinents', $_POST['continents'], PDO::PARAM_STR);
				$stmt->bindParam(':fregions', $_POST['regions'], PDO::PARAM_STR);
				$stmt->bindParam(':fcountries', $_POST['countries'], PDO::PARAM_STR);
				$stmt->bindParam(':fimages', $_POST['images'], PDO::PARAM_STR);
				$stmt->bindParam(':fimagesexternal', $_POST['imagesexternal'], PDO::PARAM_STR);
				$stmt->bindParam(':fvideos', $_POST['videos'], PDO::PARAM_STR);
				$stmt->bindParam(':fvideosexternal', $_POST['videosexternal'], PDO::PARAM_STR);
				$stmt->bindParam(':ffishbaselink', $_POST['fishbaselink'], PDO::PARAM_STR);
				$stmt->bindParam(':fwikipedialink', $_POST['wikipedialink'], PDO::PARAM_STR);
				$stmt->bindParam(':fwormslink', $_POST['wormslink'], PDO::PARAM_STR);
				$stmt->bindParam(':fitislink', $_POST['itislink'], PDO::PARAM_STR);
				$stmt->bindParam(':fpageurl', $_POST['pageurl'], PDO::PARAM_STR);
				$stmt->bindParam(':fmetadesc', $_POST['metadesc'], PDO::PARAM_STR);
				$stmt->bindParam(':fmetakeys', $_POST['metakeys'], PDO::PARAM_STR);
				$stmt->bindParam(':fcreated', $unixtime, PDO::PARAM_INT);
				$stmt->bindParam(':fmodified', $unixtime, PDO::PARAM_INT);
				$stmt->bindParam(':fusername', $_SESSION['username'], PDO::PARAM_STR);
	
				$stmt->execute();
				$stmt->closeCursor();	
				
			}
		} catch (PDOException $e) {
			return FALSE;
		}
		//header("Location: ../admin/givelife.php?status=1");
	}

	public function createLife($lifegroup) {
		switch ($lifegroup) {
			case 'Fish' :
				$this->addFish();
				break;
			case 'Nudibranch' :
				addNudi();
				break;
			default :
				echo "No group for creation";
				break;
		}
	}

}

?>