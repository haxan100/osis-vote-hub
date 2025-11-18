import {
  Dialog,
  DialogContent,
  DialogDescription,
  DialogHeader,
  DialogTitle,
} from "@/components/ui/dialog";
import { Candidate } from "@/pages/Voting";
import { ScrollArea } from "@/components/ui/scroll-area";

interface VisionMissionModalProps {
  open: boolean;
  onOpenChange: (open: boolean) => void;
  candidate: Candidate | null;
}

const VisionMissionModal = ({ open, onOpenChange, candidate }: VisionMissionModalProps) => {
  if (!candidate) return null;

  return (
    <Dialog open={open} onOpenChange={onOpenChange}>
      <DialogContent className="max-w-2xl rounded-[20px] max-h-[90vh]">
        <DialogHeader>
          <DialogTitle className="text-2xl flex items-center gap-3">
            <div className="w-10 h-10 rounded-full gradient-primary flex items-center justify-center shrink-0">
              <span className="text-xl font-bold text-primary-foreground">
                {candidate.number}
              </span>
            </div>
            <div>
              <div className="text-xl font-bold">{candidate.president}</div>
              <div className="text-sm font-normal text-muted-foreground">
                & {candidate.vicePresident}
              </div>
            </div>
          </DialogTitle>
        </DialogHeader>
        
        <ScrollArea className="max-h-[60vh] pr-4">
          <div className="space-y-6">
            <div>
              <h3 className="text-lg font-semibold text-primary mb-2">Visi</h3>
              <p className="text-foreground leading-relaxed">
                {candidate.fullVision}
              </p>
            </div>
            
            <div>
              <h3 className="text-lg font-semibold text-secondary mb-2">Misi</h3>
              <div className="text-foreground leading-relaxed whitespace-pre-line">
                {candidate.fullMission}
              </div>
            </div>
          </div>
        </ScrollArea>
      </DialogContent>
    </Dialog>
  );
};

export default VisionMissionModal;
